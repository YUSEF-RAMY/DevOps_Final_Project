<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Support\PointService;
use App\Models\Wishlist;
use App\Models\CartItem;
use App\Models\SessionEntry;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['addresses', 'orders'])
            ->latest()
            ->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['addresses', 'orders.items.product']);

        // Wishlist (latest 20)
        $wishlists = Wishlist::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->take(20)
            ->get();

        // Cart items deduped by product (latest id per product)
        $cartItemIds = DB::table('cart_items')
            ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->where('carts.user_id', $user->id)
            ->select(DB::raw('MAX(cart_items.id) as id'))
            ->groupBy('cart_items.product_id')
            ->pluck('id');
        $cartItems = CartItem::with('product')
            ->whereIn('id', $cartItemIds)
            ->orderByDesc('created_at')
            ->get();

        // Sessions for this user
        $sessions = SessionEntry::where('user_id', $user->id)
            ->orderByDesc('last_activity')
            ->take(50)
            ->get();

        return view('admin.users.show', compact('user', 'wishlists', 'cartItems', 'sessions'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
        ]);

        // Ensure at least one of email or phone present
        $email = $request->input('email');
        $phone = $request->input('phone');
        if (empty($email) && empty($phone)) {
            return back()->withErrors(['email' => 'Provide email or phone.','phone' => 'Provide email or phone.'])->withInput();
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $email ? strtolower($email) : null,
            'phone' => $phone ?: null,
        ]);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Prevent deletion of admin users
        if ($user->email === 'admin@example.com') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete admin user');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make('password')
        ]);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Password reset to "password"');
    }

    public function toggleStatus(User $user)
    {
        // You can add an 'is_active' field to users table if needed
        // For now, we'll just return a message
        return redirect()->route('admin.users.show', $user)
            ->with('info', 'User status toggle feature can be implemented');
    }

    public function adjustCoins(Request $request, User $user)
    {
        $data = $request->validate([
            'amount' => ['required','integer','not_in:0','between:-100000000,100000000'],
            'reason' => ['nullable','string','max:255'],
        ]);
        try {
            PointService::adjust($user, (int) $data['amount'], $data['reason'] ?? 'admin_adjust');
            return redirect()->route('admin.users.show', $user)->with('success', 'Coins adjusted');
        } catch (\Throwable $e) {
            return redirect()->route('admin.users.show', $user)->with('error', 'Adjustment failed');
        }
    }

    public function resetCoins(Request $request, User $user)
    {
        try {
            \DB::transaction(function () use ($user) {
                \App\Models\UserPoint::where('user_id', $user->id)->delete();
                $user->update(['coins_balance' => 0]);
            });
            return redirect()->route('admin.users.show', $user)->with('success', 'Coins reset to 0');
        } catch (\Throwable $e) {
            return redirect()->route('admin.users.show', $user)->with('error', 'Reset failed');
        }
    }

    public function lookup(Request $request)
    {
        $request->validate(['identifier' => ['required','string','max:191']]);
        $id = $request->string('identifier');
        $user = User::where('id', $id)
            ->orWhere('email', $id)
            ->orWhere('phone', $id)
            ->first();
        if(!$user){
            return response()->json(['found' => false], 404);
        }
        return response()->json([
            'found' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
        ]);
    }
}