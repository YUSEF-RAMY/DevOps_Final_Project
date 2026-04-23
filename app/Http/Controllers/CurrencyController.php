<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\CurrencyManager;

class CurrencyController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:3']
        ]);

        if (!CurrencyManager::set($request->input('code'))) {
            return back()->with('error', 'Invalid currency selection.');
        }

        return back()->with('success', 'Currency updated.');
    }
}
