<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Support\PointService;
use App\Support\ThemeHelper;
use App\Models\CoinSetting;
use App\Models\UserPoint;

class CartController extends Controller
{
	protected function currentCart(Request $request): Cart
	{
		// If user is authenticated, use user-based cart
		if (auth()->check()) {
			return Cart::firstOrCreate(
				['user_id' => auth()->id()],
				[
					'session_id' => null,
					'subtotal' => 0,
					'discount_total' => 0,
					'tax_total' => 0,
					'grand_total' => 0,
					'coupon_discount' => 0,
				]
			);
		}
		
		// For guests, use session-based cart
		$sessionId = $request->session()->get('cart_session_id');
		if (!$sessionId) {
			$sessionId = (string) Str::uuid();
			$request->session()->put('cart_session_id', $sessionId);
		}
		
		return Cart::firstOrCreate(
			['session_id' => $sessionId],
			[
				'user_id' => null,
				'subtotal' => 0,
				'discount_total' => 0,
				'tax_total' => 0,
				'grand_total' => 0,
				'coupon_discount' => 0,
			]
		);
	}

	public function index(Request $request)
	{
		$cart = $this->currentCart($request)->load('items.product');
		$availableItems = $cart->items->filter(function ($item) {
			return $item->product && $item->product->is_active && (int) $item->product->stock > 0;
		});
		$unavailableItems = $cart->items->filter(function ($item) {
			return !$item->product || !$item->product->is_active || (int) $item->product->stock <= 0;
		});
		return view(ThemeHelper::view('cart.index'), compact('cart', 'availableItems', 'unavailableItems'));
	}

	public function add(Request $request)
	{
		try {
			$request->validate([
				'product_id' => ['required', 'exists:products,id'],
				'quantity' => ['nullable', 'integer', 'min:1'],
			]);
			
			$cart = $this->currentCart($request);
			$product = Product::findOrFail($request->integer('product_id'));
			
			// Check if product is available
			if (!$product->is_active) {
				if ($request->wantsJson()) {
					return response()->json([
						'success' => false,
						'message' => 'Product is not available',
					], 422);
				}
				return redirect()->back()->with('error', 'Product is not available');
			}
			
			$quantity = max(1, (int) $request->input('quantity', 1));
			$availableStock = (int) $product->stock;
			
			// Check stock availability
			if ($availableStock <= 0) {
				if ($request->wantsJson()) {
					return response()->json([
						'success' => false,
						'message' => 'Product is out of stock',
					], 422);
				}
				return redirect()->back()->with('error', 'Product is out of stock');
			}
			
			// Clamp quantity to available stock
			$quantity = min($quantity, $availableStock);
			
			$item = CartItem::firstOrNew([
				'cart_id' => $cart->id,
				'product_id' => $product->id,
			]);
			$alreadyExisted = $item->exists;
			$awardedCoins = 0;
			
			// Calculate new quantity
			$newQuantity = ($alreadyExisted ? $item->quantity : 0) + $quantity;
			// Ensure we don't exceed stock
			$newQuantity = min($newQuantity, $availableStock);
			
			$item->quantity = $newQuantity;
			$item->unit_price = $product->price;
			$item->line_total = $item->quantity * $item->unit_price;
			$item->save();
			$this->recalculateTotals($cart);

			// Award coins for add to cart (only when product newly added to cart and under daily cap)
			if (auth()->check() && !$alreadyExisted) {
				$award = 1; $cap = 10;
				try { 
					$cs = CoinSetting::get(); 
					if (!$cs->coins_enabled || !$cs->add_to_cart_enabled) { 
						$award = 0; 
						$cap = 0; 
					} else { 
						$award = (int) max(0, (int) ($cs->add_to_cart_award ?? 1)); 
						$cap = (int) max(0, (int) ($cs->add_to_cart_daily_cap ?? 10)); 
					} 
				} catch (\Throwable $e) {}
				try {
					$todayAdds = UserPoint::where('user_id', auth()->id())
						->where('type', 'add_to_cart')
						->whereDate('created_at', now()->toDateString())
						->count();
					if ($award > 0 && $todayAdds < $cap) {
						PointService::award(auth()->user(), $award, 'add_to_cart', 'Added to cart', $item, ['product_id' => $product->id]);
						$awardedCoins = $award;
					}
				} catch (\Throwable $e) { /* ignore */ }
			}
			
			if ($request->wantsJson()) {
				$count = CartItem::where('cart_id', $cart->id)->sum('quantity');
				return response()->json([
					'success' => true,
					'message' => $alreadyExisted ? 'Item already in cart. Quantity updated.' : 'Added to cart',
					'item' => [
						'id' => $item->id,
						'quantity' => $item->quantity,
						'line_total' => (float) $item->line_total,
					],
					'cart' => [
						'count' => (int) $count,
						'subtotal' => (float) $cart->subtotal,
						'grand_total' => (float) $cart->grand_total,
					],
					'awarded_coins' => $awardedCoins,
					'user_coins' => auth()->check() ? (int) (auth()->user()->coins_balance) : null,
				]);
			}
			return redirect()->back()->with('success', $alreadyExisted ? 'Item already in cart. Quantity updated.' : 'Added to cart');
		} catch (\Illuminate\Validation\ValidationException $e) {
			if ($request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'Validation failed',
					'errors' => $e->errors(),
				], 422);
			}
			return redirect()->back()->withErrors($e->errors())->withInput();
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			if ($request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'Product not found',
				], 404);
			}
			return redirect()->back()->with('error', 'Product not found');
		} catch (\Throwable $e) {
			Log::error('Add to cart error: ' . $e->getMessage(), [
				'exception' => $e,
				'request' => $request->all(),
			]);
			
			if ($request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'An error occurred while adding item to cart. Please try again.',
				], 500);
			}
			return redirect()->back()->with('error', 'An error occurred while adding item to cart. Please try again.');
		}
	}

	public function update(Request $request, CartItem $item)
	{
		$request->validate([
			'quantity' => ['required', 'integer', 'min:1'],
		]);
		$item->quantity = (int) $request->input('quantity');
		$item->line_total = $item->quantity * $item->unit_price;
		$item->save();
        $this->recalculateTotals($item->cart);
        if ($request->wantsJson()) {
            $count = CartItem::where('cart_id', $item->cart_id)->sum('quantity');
            return response()->json([
                'success' => true,
                'message' => 'Cart updated',
                'item' => [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'line_total' => (float) $item->line_total,
                ],
                'cart' => [
                    'count' => (int) $count,
                    'subtotal' => (float) $item->cart->subtotal,
                    'grand_total' => (float) $item->cart->grand_total,
                ],
            ]);
        }
        return redirect()->back()->with('success', 'Cart updated');
	}

	public function remove(Request $request, CartItem $item)
	{
		$cart = $item->cart;
        if (auth()->check()) {
            try {
                $uid = auth()->id();
                $awarded = (int) UserPoint::where('user_id', $uid)
                    ->where('type', 'add_to_cart')
                    ->where('related_type', \App\Models\CartItem::class)
                    ->where('related_id', $item->id)
                    ->sum('amount');
                $reversed = (int) -UserPoint::where('user_id', $uid)
                    ->where('type', 'remove_from_cart')
                    ->where('related_type', \App\Models\CartItem::class)
                    ->where('related_id', $item->id)
                    ->sum('amount');
                $toReverse = max(0, $awarded - $reversed);
                if ($toReverse > 0) {
                    PointService::award(auth()->user(), -$toReverse, 'remove_from_cart', 'Removed from cart', $item, ['product_id' => $item->product_id]);
                }
            } catch (\Throwable $e) {}
        }
		$item->delete();
        $this->recalculateTotals($cart);
        if ($request->wantsJson()) {
            $count = CartItem::where('cart_id', $cart->id)->sum('quantity');
            return response()->json([
                'success' => true,
                'message' => 'Item removed',
                'cart' => [
                    'count' => (int) $count,
                    'subtotal' => (float) $cart->subtotal,
                    'grand_total' => (float) $cart->grand_total,
                ],
            ]);
        }
        return redirect()->back()->with('success', 'Item removed');
	}

	protected function recalculateTotals(Cart $cart): void
	{
		$cart->recalculateTotals();
	}

	/**
	 * Ensure cart items respect current product stock. Remove OOS items and clamp quantities.
	 * Returns a list of removed item names.
	 */
	protected function sanitizeCartStock(Cart $cart): array
	{
		$removed = [];
		$cart->load('items.product');
		foreach ($cart->items as $item) {
			$product = $item->product;
			if (!$product || !$product->is_active || (int) $product->stock <= 0) {
				// Reverse any awarded add_to_cart coins for this row
				if (auth()->check()) {
					try {
						$uid = auth()->id();
						$awarded = (int) UserPoint::where('user_id', $uid)
							->where('type', 'add_to_cart')
							->where('related_type', \App\Models\CartItem::class)
							->where('related_id', $item->id)
							->sum('amount');
						$reversed = (int) -UserPoint::where('user_id', $uid)
							->where('type', 'remove_from_cart')
							->where('related_type', \App\Models\CartItem::class)
							->where('related_id', $item->id)
							->sum('amount');
						$toReverse = max(0, $awarded - $reversed);
						if ($toReverse > 0) {
							PointService::award(auth()->user(), -$toReverse, 'remove_from_cart', 'Removed (out of stock)', $item, ['product_id' => $item->product_id]);
						}
					} catch (\Throwable $e) {}
				}
				$removed[] = $product ? $product->name : 'Unavailable product';
				$item->delete();
				continue;
			}
			// Clamp quantity to available stock
			$available = (int) $product->stock;
			if ($item->quantity > $available) {
				$item->quantity = $available;
				$item->line_total = $item->quantity * $item->unit_price;
				$item->save();
			}
		}
		$this->recalculateTotals($cart);
		return $removed;
	}

    public function clear(Request $request)
    {
        $cart = $this->currentCart($request);
        // Reverse add_to_cart coins per row according to previously awarded entries
        if (auth()->check()) {
            foreach ($cart->items as $row) {
                try {
                    $uid = auth()->id();
                    $awarded = (int) UserPoint::where('user_id', $uid)
                        ->where('type', 'add_to_cart')
                        ->where('related_type', \App\Models\CartItem::class)
                        ->where('related_id', $row->id)
                        ->sum('amount');
                    $reversed = (int) -UserPoint::where('user_id', $uid)
                        ->where('type', 'remove_from_cart')
                        ->where('related_type', \App\Models\CartItem::class)
                        ->where('related_id', $row->id)
                        ->sum('amount');
                    $toReverse = max(0, $awarded - $reversed);
                    if ($toReverse > 0) {
                        PointService::award(auth()->user(), -$toReverse, 'remove_from_cart', 'Cleared cart', $row, ['product_id' => $row->product_id]);
                    }
                } catch (\Throwable $e) {}
            }
        }
        $cart->items()->delete();
        $this->recalculateTotals($cart);
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared',
                'cart' => [
                    'count' => 0,
                    'subtotal' => (float) $cart->subtotal,
                    'grand_total' => (float) $cart->grand_total,
                ],
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }
}
