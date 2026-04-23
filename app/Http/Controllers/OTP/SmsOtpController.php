<?php

namespace App\Http\Controllers\OTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\OtpService;
use App\Models\OtpSetting;

class SmsOtpController extends Controller
{
    public function request(Request $request, OtpService $otpService)
    {
        // Check if SMS OTP is enabled
        $settings = OtpSetting::get();
        if (!$settings->sms_enabled) {
            return back()->with('error', 'SMS OTP is currently disabled. Please contact administrator.');
        }
        
        $data = $request->validate([
            'phone' => ['required','string','max:20'],
            'purpose' => ['nullable','string','max:50']
        ]);
        
        // Normalize phone number (remove spaces, dashes, etc.)
        $phoneNumber = preg_replace('/[^0-9+]/', '', $data['phone']);
        
        if (empty($phoneNumber)) {
            return back()->with('error', 'Invalid phone number format.');
        }
        
        try {
            $otp = $otpService->generate('sms', $phoneNumber, $data['purpose'] ?? 'login');
            $sent = $otpService->sendSms($otp);
            
            if ($sent) {
                return back()->with('success', 'OTP has been sent to your phone number.');
            } else {
                \Log::error('SMS OTP send failed', [
                    'phone' => $phoneNumber,
                    'purpose' => $data['purpose'] ?? 'login',
                    'package' => $settings->sms_package ?? 'unknown',
                ]);
                return back()->with('error', 'Failed to send SMS OTP. Please check your phone number and try again, or contact support.');
            }
        } catch (\Exception $e) {
            \Log::error('SMS OTP request exception: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending OTP. Please try again later.');
        }
    }

    public function verify(Request $request, OtpService $otpService)
    {
        // Check if SMS OTP is enabled
        $settings = OtpSetting::get();
        if (!$settings->sms_enabled) {
            return back()->with('error', 'SMS OTP is currently disabled. Please contact administrator.');
        }
        
        $data = $request->validate([
            'phone' => ['required','string','max:20'],
            'otp' => ['required','string','regex:/^\d{4,8}$/'], // Allow 4-8 digits (configurable length)
            'purpose' => ['nullable','string','max:50']
        ]);
        
        // Normalize phone number
        $phoneNumber = preg_replace('/[^0-9+]/', '', $data['phone']);
        
        if (empty($phoneNumber)) {
            return back()->with('error', 'Invalid phone number format.');
        }
        
        try {
            $ok = $otpService->verify('sms', $phoneNumber, $data['otp'], $data['purpose'] ?? 'login');
            
            if ($ok) {
                return back()->with('success', 'OTP verified successfully.');
            } else {
                return back()->with('error', 'Invalid or expired OTP. Please check the code and try again.');
            }
        } catch (\Exception $e) {
            \Log::error('SMS OTP verify exception: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while verifying OTP. Please try again.');
        }
    }
}
