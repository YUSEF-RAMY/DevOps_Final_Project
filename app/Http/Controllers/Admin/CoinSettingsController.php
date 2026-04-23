<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoinSetting;

class CoinSettingsController extends Controller
{
    public function index()
    {
        $settings = CoinSetting::get();
        return view('admin.coin-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'coins_enabled' => ['sometimes','boolean'],
            'add_to_cart_enabled' => ['sometimes','boolean'],
            'order_award_enabled' => ['sometimes','boolean'],
            'referral_enabled' => ['sometimes','boolean'],
            'add_to_cart_award' => ['required','integer','min:0','max:1000'],
            'add_to_cart_daily_cap' => ['required','integer','min:0','max:1000'],
            'order_rate_per' => ['required','integer','min:1','max:100000'],
            'order_rate_coins' => ['required','integer','min:0','max:1000'],
            'order_min_award' => ['required','integer','min:0','max:1000'],
            'cod_bonus' => ['required','integer','min:0','max:1000'],
            'referral_signup_bonus' => ['required','integer','min:0','max:1000'],
        ]);
        $settings = CoinSetting::get();
        $settings->update([
            'coins_enabled' => $request->boolean('coins_enabled'),
            'add_to_cart_enabled' => $request->boolean('add_to_cart_enabled'),
            'order_award_enabled' => $request->boolean('order_award_enabled'),
            'referral_enabled' => $request->boolean('referral_enabled'),
            'add_to_cart_award' => $data['add_to_cart_award'],
            'add_to_cart_daily_cap' => $data['add_to_cart_daily_cap'],
            'order_rate_per' => $data['order_rate_per'],
            'order_rate_coins' => $data['order_rate_coins'],
            'order_min_award' => $data['order_min_award'],
            'cod_bonus' => $data['cod_bonus'],
            'referral_signup_bonus' => $data['referral_signup_bonus'],
        ]);
        return back()->with('success','Coin settings updated.');
    }
}


