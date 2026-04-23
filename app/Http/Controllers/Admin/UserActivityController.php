<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Wishlist;
use App\Models\GuestWishlist;
use Illuminate\Support\Facades\DB;
use App\Models\SessionEntry;
use App\Models\User;

class UserActivityController extends Controller
{
    public function carts(Request $request)
    {
        // Show one row per (user_id, product_id) for authenticated users
        $ids = DB::table('cart_items')
            ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->whereNotNull('carts.user_id')
            ->select(DB::raw('MAX(cart_items.id) as id'))
            ->groupBy('carts.user_id', 'cart_items.product_id')
            ->pluck('id');

        $items = CartItem::with(['product', 'cart.user'])
            ->whereIn('id', $ids)
            ->orderByDesc('created_at')
            ->paginate(50)
            ->withQueryString();
        return view('admin.user-activity.carts', compact('items'));
    }

    public function wishlists(Request $request)
    {
        $items = Wishlist::with(['product', 'user'])
            ->orderByDesc('created_at')
            ->paginate(50)
            ->withQueryString();

        // Deduplicate guest wishlist by (session_id, product_id)
        $guestIds = DB::table('guest_wishlists')
            ->select(DB::raw('MAX(id) as id'))
            ->groupBy('session_id', 'product_id')
            ->pluck('id');

        $guestItems = GuestWishlist::with(['product'])
            ->whereIn('id', $guestIds)
            ->orderByDesc('created_at')
            ->paginate(50, ['*'], 'guest_page')
            ->withQueryString();

        return view('admin.user-activity.wishlists', compact('items', 'guestItems'));
    }

    public function sessions(Request $request)
    {
        $sessions = SessionEntry::with('user')
            ->orderByDesc('last_activity')
            ->paginate(50)
            ->withQueryString();
        return view('admin.user-activity.sessions', compact('sessions'));
    }

    public function destroySession(Request $request, string $sessionId)
    {
        SessionEntry::where('id', $sessionId)->delete();
        return redirect()->back()->with('success', 'Session destroyed');
    }

    public function destroyUserSessions(Request $request, User $user)
    {
        SessionEntry::where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'All sessions for user destroyed');
    }
}


