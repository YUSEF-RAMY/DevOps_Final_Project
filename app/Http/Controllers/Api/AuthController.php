<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','string','email','max:255','unique:users,email'],
            'phone' => ['nullable','string','max:20','unique:users,phone'],
            'password' => ['required', Password::min(8)],
        ]);

        if (empty($validated['email']) && empty($validated['phone'])) {
            return response()->json(['message' => 'Provide email or phone.'], 422);
        }

        $user = new User();
        $user->name = $validated['name'];
        $user->email = isset($validated['email']) ? strtolower($validated['email']) : null;
        $user->phone = $validated['phone'] ?? null;
        $user->password = Hash::make($validated['password']);
        $user->save();

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $this->userResource($user),
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required','string','max:255'],
            'password' => ['required','string'],
        ]);

        $login = $request->string('login');
        $credentials = ['password' => $request->password];
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = strtolower($login);
        } else {
            $credentials['phone'] = $login;
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('mobile')->plainTextToken;

        // Merge guest cart session into user cart if session is provided
        $sessionId = (string) $request->header('X-Cart-Session', '');
        if ($sessionId !== '') {
            $this->mergeSessionCartWithUserCart($sessionId, $user->id);
        }

        return response()->json([
            'token' => $token,
            'user' => $this->userResource($user),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true]);
    }

    public function me(Request $request)
    {
        return response()->json($this->userResource($request->user()));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','string','email','max:255','unique:users,email,' . $user->id],
            'phone' => ['nullable','string','max:20','unique:users,phone,' . $user->id],
        ]);

        if (empty($validated['email']) && empty($validated['phone'])) {
            return response()->json(['message' => 'Provide email or phone.'], 422);
        }

        $user->update([
            'name' => $validated['name'],
            'email' => isset($validated['email']) ? strtolower($validated['email']) : null,
            'phone' => $validated['phone'] ?? null,
        ]);

        return response()->json($this->userResource($user));
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'current_password' => ['required','string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }
        $user->password = Hash::make($validated['password']);
        $user->save();
        return response()->json(['success' => true]);
    }

    private function userResource(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
        ];
    }

    private function mergeSessionCartWithUserCart(string $sessionId, int $userId): void
    {
        $sessionCart = Cart::where('session_id', $sessionId)->with('items')->first();
        if (!$sessionCart || $sessionCart->items->isEmpty()) {
            return;
        }

        $userCart = Cart::where('user_id', $userId)->with('items')->first();

        if ($userCart) {
            // Merge session cart items into user cart
            foreach ($sessionCart->items as $sessionItem) {
                $existingItem = $userCart->items()
                    ->where('product_id', $sessionItem->product_id)
                    ->first();

                if ($existingItem) {
                    // Update quantity
                    $existingItem->quantity += $sessionItem->quantity;
                    $existingItem->line_total = $existingItem->quantity * $existingItem->unit_price;
                    $existingItem->save();
                } else {
                    // Add new item
                    $sessionItem->cart_id = $userCart->id;
                    $sessionItem->save();
                }
            }

            // Recalculate totals
            $this->recalculateTotals($userCart);
            
            // Delete session cart
            $sessionCart->items()->delete();
            $sessionCart->delete();
        } else {
            // Convert session cart to user cart
            $sessionCart->user_id = $userId;
            $sessionCart->session_id = null;
            $sessionCart->save();
        }
    }

    private function recalculateTotals(Cart $cart): void
    {
        $cart->recalculateTotals();
    }
}


