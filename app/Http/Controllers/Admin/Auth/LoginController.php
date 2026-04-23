<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		return view('admin.auth.login');
	}

	public function login(Request $request)
	{
		// Validate CAPTCHA FIRST, before any other validation
		$captchaInput = $request->input('captcha');
		$captchaValid = \App\Http\Controllers\Admin\CaptchaController::verify($captchaInput);
		
		if (!$captchaValid) {
			return back()->withErrors(['captcha' => 'Invalid CAPTCHA code. Please try again.'])->withInput($request->only('email'));
		}
		
		// Now validate other fields
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);
		
		if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
			$request->session()->regenerate();
			return redirect()->intended(route('admin.dashboard'));
		}
		return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
	}

	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('admin.login');
	}
}
