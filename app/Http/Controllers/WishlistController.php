<?php

namespace App\Http\Controllers;

use App\Models\GuestWishlist;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Support\ThemeHelper;

class WishlistController extends Controller
{

    protected function isEnabled(): bool
    {
        $settings = SiteSetting::get();
        return (bool) ($settings->wishlist_enabled ?? true);
    }

    public function index(Request $request)
    {
        if (!$this->isEnabled()) {
            abort(404);
        }

        if ($request->user()) {
            $items = Wishlist::with('product.images')
                ->where('user_id', $request->user()->id)
                ->latest()
                ->get();
        } else {
            $sessionId = $request->session()->get('wishlist_session_id');
            if (!$sessionId) {
                $items = collect();
            } else {
                $items = GuestWishlist::with('product.images')
                    ->where('session_id', $sessionId)
                    ->latest()
                    ->get();
            }
        }

        return view(ThemeHelper::view('user.wishlist.index'), compact('items'));
    }

    public function toggle(Request $request)
    {
        if (!$this->isEnabled()) {
            return response()->json(['success' => false, 'message' => 'Wishlist disabled'], 403);
        }

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $productId = (int) $request->input('product_id');

        if ($request->user()) {
            $userId = $request->user()->id;
            $existing = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();
            if ($existing) {
                $existing->delete();
                $count = Wishlist::where('user_id', $userId)->count();
                return response()->json(['success' => true, 'state' => 'removed', 'count' => $count]);
            }
            Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
            $count = Wishlist::where('user_id', $userId)->count();
            return response()->json(['success' => true, 'state' => 'added', 'count' => $count]);
        }

        // Guest: use session-based storage
        $sessionId = $request->session()->get('wishlist_session_id');
        if (!$sessionId) {
            $sessionId = (string) Str::uuid();
            $request->session()->put('wishlist_session_id', $sessionId);
        }
        $existing = GuestWishlist::where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->first();
        if ($existing) {
            $existing->delete();
            $count = GuestWishlist::where('session_id', $sessionId)->count();
            return response()->json(['success' => true, 'state' => 'removed', 'count' => $count]);
        }
        GuestWishlist::create(['session_id' => $sessionId, 'product_id' => $productId]);
        $count = GuestWishlist::where('session_id', $sessionId)->count();
        return response()->json(['success' => true, 'state' => 'added', 'count' => $count]);
    }
}



