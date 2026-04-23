<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Cart;
use App\Support\PointService;
use App\Support\ThemeHelper;
use App\Models\CoinSetting;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view(ThemeHelper::view('auth.login'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required','string','max:255'], // email or phone
            'password' => ['required','string'],
        ]);

        $login = $request->string('login');
        $credentials = ['password' => $request->password];
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = strtolower($login);
        } else {
            $credentials['phone'] = $login;
        }
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Merge session cart with user cart
            $this->mergeSessionCartWithUserCart($request);
            // Ensure referral code exists for existing users
            try {
                $user = Auth::user();
                if (empty($user->referral_code)) {
                    $user->referral_code = strtoupper(substr(sha1($user->id . '|' . now()->timestamp), 0, 8));
                    $user->save();
                }
            } catch (\Throwable $e) {}
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function showRegisterForm(Request $request)
    {
        $referralCode = $request->session()->get('referral_code');
        $referrerName = $request->session()->get('referrer_name');
        return view(ThemeHelper::view('auth.register'), compact('referralCode', 'referrerName'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','string','email','max:255','unique:users,email'],
            'phone' => ['nullable','string','max:20','unique:users,phone'],
            'password' => ['required','confirmed', Password::defaults()],
        ]);

        if (empty($data['email']) && empty($data['phone'])) {
            return back()->withErrors(['email' => 'Provide email or phone.','phone' => 'Provide email or phone.'])->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => isset($data['email']) ? strtolower($data['email']) : null,
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        // Generate referral code if missing
        if (empty($user->referral_code)) {
            $user->referral_code = strtoupper(substr(sha1($user->id . '|' . now()->timestamp), 0, 8));
            $user->save();
        }

        // Attach referrer & award signup bonus (respects Coin Settings flags)
        try {
            if ($request->session()->has('referral_code')) {
                $code = strtoupper(trim((string) $request->session()->get('referral_code')));
                $referrer = User::where('referral_code', $code)->first();
                if ($referrer && $referrer->id !== $user->id) {
                    $user->referred_by_user_id = $referrer->id;
                    $user->save();
                    
                    // Award bonus to referrer
                    $bonus = 0; $enabledAll = true; $enabledReferral = true;
                    try {
                        $cs = CoinSetting::get();
                        $enabledAll = (bool) ($cs->coins_enabled ?? true);
                        $enabledReferral = (bool) ($cs->referral_enabled ?? true);
                        $bonus = (int) max(0, (int) ($cs->referral_signup_bonus ?? 0));
                    } catch (\Throwable $e) {}
                    if ($enabledAll && $enabledReferral && $bonus > 0) {
                        PointService::award($referrer, $bonus, 'referral_signup', 'Referral signup bonus', $user, ['referred_user_id' => $user->id]);
                    }
                    
                    // Clear referral session after successful registration
                    $request->session()->forget(['referral_code', 'referrer_name']);
                }
            }
        } catch (\Throwable $e) { 
            // Log error but don't break registration
            \Log::error('Referral processing error: ' . $e->getMessage());
        }

        Auth::login($user);

        // Merge session cart with user cart
        $this->mergeSessionCartWithUserCart($request);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showProfile()
    {
        $user = Auth::user();
        // Ensure referral code exists for display
        try {
            if (empty($user->referral_code)) {
                $user->referral_code = strtoupper(substr(sha1($user->id . '|' . now()->timestamp), 0, 8));
                $user->save();
            }
        } catch (\Throwable $e) {}
        // Recompute coins from ledger to ensure accuracy
        try {
            $coins = \App\Models\UserPoint::where('user_id', $user->id)->sum('amount');
            if ((int) ($user->coins_balance ?? 0) !== (int) $coins) {
                $user->coins_balance = (int) $coins;
                $user->save();
            }
        } catch (\Throwable $e) {
            $coins = (int) ($user->coins_balance ?? 0);
        }
        $coinsBalance = (int) $coins;
        $recentPoints = \App\Models\UserPoint::where('user_id', $user->id)->latest()->limit(20)->get();
        $myReviews = $user->reviews()->with('product')->latest()->paginate(5);
        return view(ThemeHelper::view('auth.profile'), compact('user', 'coinsBalance', 'recentPoints', 'myReviews'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['nullable','string','email','max:255','unique:users,email,' . $user->id],
            'phone' => ['nullable','string','max:20','unique:users,phone,' . $user->id],
        ]);

        // Ensure at least one of email or phone remains present
        if (empty($validated['email']) && empty($validated['phone'])) {
            return back()->withErrors(['email' => 'Provide email or phone.','phone' => 'Provide email or phone.'])->withInput();
        }

        $user->update([
            'name' => $validated['name'],
            'email' => isset($validated['email']) ? strtolower($validated['email']) : null,
            'phone' => $validated['phone'] ?? null,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Password changed successfully!');
    }

    protected function mergeSessionCartWithUserCart(Request $request)
    {
        $sessionId = $request->session()->get('cart_session_id');
        if (!$sessionId) {
            return;
        }

        $sessionCart = Cart::where('session_id', $sessionId)->with('items')->first();
        if (!$sessionCart) {
            return;
        }

        $userCart = Cart::where('user_id', auth()->id())->with('items')->first();

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
            $sessionCart->user_id = auth()->id();
            $sessionCart->session_id = null;
            $sessionCart->save();
        }

        $request->session()->forget('cart_session_id');
    }

    protected function recalculateTotals(Cart $cart): void
    {
        $cart->recalculateTotals();
    }
}