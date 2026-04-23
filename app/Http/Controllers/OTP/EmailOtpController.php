<?php

namespace App\Http\Controllers\OTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\OtpService;
use App\Models\OtpSetting;

class EmailOtpController extends Controller
{
    public function request(Request $request, OtpService $otpService)
    {
        // Check if Email OTP is enabled
        $settings = OtpSetting::get();
        if (!$settings->email_enabled) {
            return back()->with('error', 'Email OTP is currently disabled. Please contact administrator.');
        }
        
        $data = $request->validate([
            'email' => ['required','email','max:255'],
            'purpose' => ['nullable','string','max:50']
        ]);
        
        try {
            $email = strtolower(trim($data['email']));
            $otp = $otpService->generate('email', $email, $data['purpose'] ?? 'login');
            $otpService->sendEmail($otp);
            return back()->with('success', 'OTP has been sent to your email address.');
        } catch (\Exception $e) {
            \Log::error('Email OTP request exception: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending OTP. Please try again later.');
        }
    }

    public function verify(Request $request, OtpService $otpService)
    {
        // Check if Email OTP is enabled
        $settings = OtpSetting::get();
        if (!$settings->email_enabled) {
            return back()->with('error', 'Email OTP is currently disabled. Please contact administrator.');
        }
        
        $data = $request->validate([
            'email' => ['required','email','max:255'],
            'otp' => ['required','string','regex:/^\d{4,8}$/'], // Allow 4-8 digits (configurable length)
            'purpose' => ['nullable','string','max:50']
        ]);
        
        try {
            $email = strtolower(trim($data['email']));
            $ok = $otpService->verify('email', $email, $data['otp'], $data['purpose'] ?? 'login');
            
            if ($ok) {
                return back()->with('success', 'OTP verified successfully.');
            } else {
                return back()->with('error', 'Invalid or expired OTP. Please check the code and try again.');
            }
        } catch (\Exception $e) {
            \Log::error('Email OTP verify exception: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while verifying OTP. Please try again.');
        }
    }
}
