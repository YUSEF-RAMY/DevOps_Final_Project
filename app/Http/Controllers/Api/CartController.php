<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Support\CurrencyManager;

class CartController extends Controller
{
    public function show(Request $request)
    {
        try {
            [$cart, $cartSession] = $this->getOrCreateCart($request);
            
            // CRITICAL: Always refresh cart to get latest data from database
            $cart->refresh();
            $cart->load('items.product.images');
            
            // Log cart state for debugging
            Log::info('Cart API: GET /cart', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'user_id' => $cart->user_id,
                'items_count' => $cart->items->count(),
                'product_ids' => $cart->items->pluck('product_id')->toArray(),
            ]);
            
            return response()->json($this->cartResource($cart, $cartSession));
        } catch (\Throwable $e) {
            Log::error('API Get cart error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            
            return response()->json([
                'message' => 'An error occurred while retrieving cart. Please try again.',
                'error' => 'INTERNAL_ERROR'
            ], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => ['required','exists:products,id'],
                'quantity' => ['nullable','integer','min:1'],
            ]);
            
            // Get or create cart - this ensures we always use the same cart
            [$cart, $cartSession] = $this->getOrCreateCart($request);
            
            // CRITICAL: Log cart state BEFORE adding
            Log::info('Cart API: Before adding item', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'user_id' => $cart->user_id,
                'existing_items_count' => $cart->items()->count(),
                'existing_product_ids' => $cart->items()->pluck('product_id')->toArray(),
                'requested_product_id' => $request->integer('product_id'),
                'cart_session_from_header' => $request->header('X-Cart-Session'),
                'cart_session_returned' => $cartSession,
            ]);
            
            $product = Product::where('id', $request->integer('product_id'))
                ->where('is_active', true)->firstOrFail();
            
            // Check stock availability
            $availableStock = (int) $product->stock;
            if ($availableStock <= 0) {
                return response()->json([
                    'message' => 'Product is out of stock',
                    'error' => 'OUT_OF_STOCK'
                ], 422);
            }
            
            $qty = max(1, (int) $request->input('quantity', 1));
            $qty = min($qty, $availableStock);
            
            // CRITICAL: Reload cart items before checking for existing item
            // This ensures we have the latest items from database
            $cart->load('items');
            
            // Find existing item in THIS cart
            $existing = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();
            
            if ($existing) {
                // Update existing item quantity
                $oldQuantity = $existing->quantity;
                $newQuantity = min($availableStock, $existing->quantity + $qty);
                $existing->quantity = $newQuantity;
                $existing->line_total = $existing->quantity * (float) $existing->unit_price;
                $existing->save();
                
                Log::info('Cart API: Updated existing item', [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'old_quantity' => $oldQuantity,
                    'new_quantity' => $newQuantity,
                ]);
            } else {
                // Create new cart item for different product
                $newItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => (float) $product->price,
                    'line_total' => (float) $product->price * $qty,
                ]);
                
                // CRITICAL: Refresh the item to ensure it's saved
                $newItem->refresh();
                
                Log::info('Cart API: Created new cart item', [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'item_id' => $newItem->id,
                    'item_saved' => $newItem->exists,
                ]);
            }
            
            // CRITICAL: Recalculate and reload cart - ensure we get fresh data from database
            $cart->recalculateTotals();
            // Force refresh from database to ensure we have the latest items
            $cart->refresh();
            // Clear any cached relationships and reload fresh
            $cart->unsetRelation('items');
            $cart->load('items.product.images');
            
            // Log cart state for debugging
            Log::info('Cart API: After adding item', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'user_id' => $cart->user_id,
                'items_count' => $cart->items->count(),
                'product_ids' => $cart->items->pluck('product_id')->toArray(),
                'product_names' => $cart->items->map(function($item) {
                    return $item->product ? $item->product->name : 'Unknown';
                })->toArray(),
            ]);
            
            // Return updated cart with session
            return response()->json($this->cartResource($cart, $cartSession));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found or not available',
                'error' => 'PRODUCT_NOT_FOUND'
            ], 404);
        } catch (\Throwable $e) {
            Log::error('API Add to cart error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            
            return response()->json([
                'message' => 'An error occurred while adding item to cart. Please try again.',
                'error' => 'INTERNAL_ERROR'
            ], 500);
        }
    }

    public function update(Request $request, CartItem $item)
    {
        try {
            $request->validate([
                'quantity' => ['required','integer','min:1'],
            ]);
            
            // Get the cart first to ensure we have the right one
            $cart = $item->cart;
            
            $product = $item->product;
            if (!$product || !$product->is_active) {
                return response()->json([
                    'message' => 'Product is not available',
                    'error' => 'PRODUCT_UNAVAILABLE'
                ], 422);
            }
            
            $availableStock = (int) $product->stock;
            if ($availableStock <= 0) {
                return response()->json([
                    'message' => 'Product is out of stock',
                    'error' => 'OUT_OF_STOCK'
                ], 422);
            }
            
            $qty = (int) $request->input('quantity');
            $qty = min($qty, $availableStock);
            
            // Update ONLY this item - never touch other items
            $item->quantity = $qty;
            $item->line_total = $qty * (float) $item->unit_price;
            $item->save();
            
            // Recalculate totals (this only updates totals, never deletes items)
            $cart->recalculateTotals();
            
            // Reload cart with ALL items to ensure complete response
            $cart->refresh();
            $cart->load('items.product.images');
            
            // Log to verify all items are present
            Log::info('Cart API: After updating item', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'items_count' => $cart->items->count(),
                'product_ids' => $cart->items->pluck('product_id')->toArray(),
                'updated_item_id' => $item->id,
            ]);
            
            // Get session for guest users - always use cart's session_id if available
            $cartSession = null;
            if (!$cart->user_id) {
                $cartSession = $cart->session_id ?? trim((string) $request->header('X-Cart-Session', ''));
                if ($cartSession === '') {
                    $cartSession = (string) Str::uuid();
                }
            }
            
            // Return COMPLETE cart with ALL items
            return response()->json($this->cartResource($cart, $cartSession));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('API Update cart item error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            
            return response()->json([
                'message' => 'An error occurred while updating cart item. Please try again.',
                'error' => 'INTERNAL_ERROR'
            ], 500);
        }
    }

    public function remove(Request $request, CartItem $item)
    {
        try {
            $cart = $item->cart;
            
            // Delete ONLY this item - never touch other items
            $item->delete();
            
            // Recalculate totals (this only updates totals, never deletes items)
            $cart->recalculateTotals();
            
            // Reload cart with ALL remaining items
            $cart->refresh();
            $cart->load('items.product');
            
            // Log to verify remaining items
            Log::info('Cart API: After removing item', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'items_count' => $cart->items->count(),
                'product_ids' => $cart->items->pluck('product_id')->toArray(),
                'removed_item_id' => $item->id,
            ]);
            
            // Get session for guest users - always use cart's session_id if available
            $cartSession = null;
            if (!$cart->user_id) {
                $cartSession = $cart->session_id ?? trim((string) $request->header('X-Cart-Session', ''));
                if ($cartSession === '') {
                    $cartSession = (string) Str::uuid();
                }
            }
            
            // Return COMPLETE cart with ALL remaining items
            return response()->json($this->cartResource($cart, $cartSession));
        } catch (\Throwable $e) {
            Log::error('API Remove cart item error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            
            return response()->json([
                'message' => 'An error occurred while removing cart item. Please try again.',
                'error' => 'INTERNAL_ERROR'
            ], 500);
        }
    }

    public function clear(Request $request)
    {
        try {
            [$cart, $cartSession] = $this->getOrCreateCart($request);
            
            // Delete all items
            $cart->items()->delete();
            
            // Recalculate totals (this will set all totals to 0)
            $cart->recalculateTotals();
            
            // Reload cart to ensure we have the latest state
            $cart->refresh();
            $cart->load('items.product');
            
            // Log cart state after clearing
            Log::info('Cart API: After clearing cart', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'items_count' => $cart->items->count(),
            ]);
            
            return response()->json($this->cartResource($cart, $cartSession));
        } catch (\Throwable $e) {
            Log::error('API Clear cart error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            
            return response()->json([
                'message' => 'An error occurred while clearing cart. Please try again.',
                'error' => 'INTERNAL_ERROR'
            ], 500);
        }
    }

    private function getOrCreateCart(Request $request): array
    {
        $userId = auth()->id();
        
        // For authenticated users, use user_id
        if ($userId) {
            $cart = Cart::firstOrCreate(
                ['user_id' => $userId],
                [
                    'session_id' => null,
                    'subtotal' => 0,
                    'discount_total' => 0,
                    'tax_total' => 0,
                    'grand_total' => 0,
                    'coupon_discount' => 0,
                ]
            );
            // Always refresh to get latest items
            $cart->refresh();
            $cart->load('items');
            Log::info('Cart API: User cart', [
                'cart_id' => $cart->id,
                'user_id' => $userId,
                'items_count' => $cart->items->count(),
            ]);
            return [$cart, null];
        }
        
        // For guests, use session_id from header or create new
        $session = trim((string) $request->header('X-Cart-Session', ''));
        
        // Log for debugging
        Log::info('Cart API: getOrCreateCart (Guest)', [
            'session_from_header' => $session,
            'header_exists' => $request->hasHeader('X-Cart-Session'),
            'header_value' => $request->header('X-Cart-Session'),
            'header_raw' => $request->headers->get('X-Cart-Session'),
        ]);
        
        if ($session === '') {
            // No session provided, create new one
            $session = (string) Str::uuid();
            Log::info('Cart API: Created new session', ['session' => $session]);
        }
        
        // CRITICAL: First try to find existing cart by session_id
        // Use whereNull('user_id') to ensure we only get guest carts
        // Also check if session is not empty to avoid matching null sessions
        $cart = Cart::where('session_id', $session)
            ->whereNull('user_id')
            ->whereNotNull('session_id')
            ->first();
        
        if (!$cart) {
            // No existing cart found, create new one
            $cart = Cart::create([
                'session_id' => $session,
                'user_id' => null,
                'subtotal' => 0,
                'discount_total' => 0,
                'tax_total' => 0,
                'grand_total' => 0,
                'coupon_discount' => 0,
            ]);
            // CRITICAL: Refresh and load items even for new cart to ensure consistency
            $cart->refresh();
            $cart->load('items');
            Log::info('Cart API: Created new cart', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'items_count' => $cart->items->count(),
            ]);
        } else {
            // CRITICAL: Refresh cart to ensure we have latest data
            $cart->refresh();
            $cart->load('items');
            Log::info('Cart API: Found existing cart', [
                'cart_id' => $cart->id,
                'session_id' => $cart->session_id,
                'items_count' => $cart->items->count(),
                'product_ids' => $cart->items->pluck('product_id')->toArray(),
            ]);
        }
        
        // Always return the session so client can save and reuse it
        return [$cart, $session];
    }

    private function money(float $amount): array
    {
        return [
            'amount' => $amount,
            'formatted' => CurrencyManager::format($amount),
        ];
    }

    private function cartResource(Cart $cart, ?string $cartSession = null): array
    {
        // CRITICAL: Ensure we have fresh items from database
        // Refresh cart first to get latest data, then reload relationships
        $cart->refresh();
        // Clear any cached relationships and reload fresh
        if (method_exists($cart, 'unsetRelation')) {
            $cart->unsetRelation('items');
        }
        $cart->load('items.product.images');
        
        // CRITICAL: Map ALL items - never filter or skip any
        // This ensures the client always receives the complete cart state
        $items = $cart->items->map(function ($it) {
            $product = $it->product;
            return [
                'id' => $it->id,
                'product' => $product ? [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'sku' => $product->sku,
                    'stock' => (int) $product->stock,
                    'price' => $this->money((float) $product->price),
                    'images' => $product->images->map(function ($img) {
                        return [
                            'id' => $img->id,
                            'path' => $img->path,
                            'is_primary' => (bool) $img->is_primary,
                        ];
                    })->values()->toArray(),
                ] : null,
                'quantity' => (int) $it->quantity,
                'unit_price' => $this->money((float) $it->unit_price),
                'line_total' => $this->money((float) $it->line_total),
            ];
        })->values(); // Use values() to ensure sequential array indices
        
        // Log the resource being returned for debugging
        Log::info('Cart API: Returning cart resource', [
            'cart_id' => $cart->id,
            'session_id' => $cart->session_id,
            'user_id' => $cart->user_id,
            'items_count' => $items->count(),
            'items_count_from_relation' => $cart->items->count(),
            'product_ids' => $items->pluck('product.id')->filter()->toArray(),
            'product_names' => $items->pluck('product.name')->filter()->toArray(),
            'cart_session_returned' => $cartSession,
        ]);
        
        return [
            'cart_session' => $cartSession,
            'items' => $items,
            'totals' => [
                'subtotal' => $this->money((float) $cart->subtotal),
                'discount_total' => $this->money((float) $cart->discount_total),
                'tax_total' => $this->money((float) $cart->tax_total),
                'grand_total' => $this->money((float) $cart->grand_total),
            ],
        ];
    }
}


