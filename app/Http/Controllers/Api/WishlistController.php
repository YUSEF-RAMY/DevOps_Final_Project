<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\GuestWishlist;
use App\Models\SiteSetting;

class WishlistController extends Controller
{
    /**
     * GET /api/wishlist (auth or guest)
     */
    public function index(Request $request)
    {
        $this->ensureEnabled();
        $user = $request->user();
        
        if ($user) {
            // Authenticated user
            $items = Wishlist::with('product')
                ->where('user_id', $user->id)
                ->latest()
                ->get()
                ->map(function ($w) {
                    return [
                        'product' => $w->product ? [
                            'id' => $w->product->id,
                            'name' => $w->product->name,
                            'slug' => $w->product->slug,
                            'sku' => $w->product->sku,
                        ] : null,
                    ];
                });
            
            // CRITICAL: Always return accurate count from database
            $count = Wishlist::where('user_id', $user->id)->count();
            
            return response()->json([
                'items' => $items,
                'count' => $count, // Use database count, not collection count
            ]);
        }
        
        // Guest user - use session
        $session = trim((string) $request->header('X-Wishlist-Session', ''));
        if ($session === '') {
            // No session, return empty wishlist
            return response()->json([
                'items' => [],
                'count' => 0,
            ]);
        }
        
        $items = GuestWishlist::with('product')
            ->where('session_id', $session)
            ->latest()
            ->get()
            ->map(function ($w) {
                return [
                    'product' => $w->product ? [
                        'id' => $w->product->id,
                        'name' => $w->product->name,
                        'slug' => $w->product->slug,
                        'sku' => $w->product->sku,
                    ] : null,
                ];
            });
        
        // CRITICAL: Always return accurate count from database
        $count = GuestWishlist::where('session_id', $session)->count();
        
        return response()->json([
            'items' => $items,
            'count' => $count, // Use database count, not collection count
        ]);
    }

    /**
     * POST /api/wishlist/toggle (guest or auth)
     * Header: X-Wishlist-Session (for guests; if missing, server returns one)
     */
    public function toggle(Request $request)
    {
        $this->ensureEnabled();
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);
        $productId = (int) $request->input('product_id');

        if ($request->user()) {
            // Authenticated user
            $userId = $request->user()->id;
            $existing = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
            
            if ($existing) {
                $existing->delete();
                // Get accurate count after deletion
                $count = Wishlist::where('user_id', $userId)->count();
                return response()->json([
                    'success' => true,
                    'state' => 'removed',
                    'count' => $count,
                ]);
            }
            
            // Add to wishlist
            Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
            // Get accurate count after addition
            $count = Wishlist::where('user_id', $userId)->count();
            return response()->json([
                'success' => true,
                'state' => 'added',
                'count' => $count,
            ]);
        }

        // Guest: use header-based wishlist session (like cart's X-Cart-Session)
        $session = trim((string) $request->header('X-Wishlist-Session', ''));
        if ($session === '') {
            $session = (string) Str::uuid();
        }
        
        $existing = GuestWishlist::where('session_id', $session)->where('product_id', $productId)->first();
        
        if ($existing) {
            $existing->delete();
            // Get accurate count after deletion
            $count = GuestWishlist::where('session_id', $session)->count();
            return response()->json([
                'success' => true,
                'state' => 'removed',
                'count' => $count,
                'wishlist_session' => $session, // Always return session for guest users
            ]);
        }
        
        // Add to wishlist
        GuestWishlist::create(['session_id' => $session, 'product_id' => $productId]);
        // Get accurate count after addition
        $count = GuestWishlist::where('session_id', $session)->count();
        return response()->json([
            'success' => true,
            'state' => 'added',
            'count' => $count,
            'wishlist_session' => $session, // Always return session for guest users
        ]);
    }

    private function ensureEnabled(): void
    {
        $settings = SiteSetting::get();
        if (!($settings->wishlist_enabled ?? true)) {
            abort(404);
        }
    }
}


