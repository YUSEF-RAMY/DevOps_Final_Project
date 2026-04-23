<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtpSetting;

class OtpSettingsController extends Controller
{
    public function index()
    {
        $settings = OtpSetting::get();
        
        // Define available SMS packages with sandbox support and required fields
        $smsPackages = [
            'laravel_bdsms' => [
                'name' => 'Laravel BDSMS (Xenon)', 
                'sandbox' => false, 
                'description' => 'Bangladeshi SMS gateway package',
                'required_fields' => ['sms_gateway', 'sms_username', 'sms_password', 'sms_masking'],
                'optional_fields' => ['sms_sender'],
            ],
            'twilio' => [
                'name' => 'Twilio', 
                'sandbox' => true, 
                'description' => 'Popular international SMS service',
                'required_fields' => ['sms_api_key', 'sms_password', 'sms_sender'],
                'optional_fields' => ['sms_username'],
            ],
            'vonage' => [
                'name' => 'Vonage (Nexmo)', 
                'sandbox' => true, 
                'description' => 'Global SMS and voice API',
                'required_fields' => ['sms_api_key', 'sms_password', 'sms_sender'],
                'optional_fields' => [],
            ],
            'messagebird' => [
                'name' => 'MessageBird', 
                'sandbox' => true, 
                'description' => 'Cloud communications platform',
                'required_fields' => ['sms_api_key', 'sms_sender'],
                'optional_fields' => [],
            ],
            'aws_sns' => [
                'name' => 'AWS SNS', 
                'sandbox' => true, 
                'description' => 'Amazon Simple Notification Service',
                'required_fields' => ['sms_username', 'sms_password', 'sms_api_url'],
                'optional_fields' => ['sms_sender'],
            ],
            'clickatell' => [
                'name' => 'Clickatell', 
                'sandbox' => true, 
                'description' => 'Enterprise messaging platform',
                'required_fields' => ['sms_api_key', 'sms_api_url'],
                'optional_fields' => ['sms_sender'],
            ],
            'plivo' => [
                'name' => 'Plivo', 
                'sandbox' => true, 
                'description' => 'Cloud communications API',
                'required_fields' => ['sms_username', 'sms_password', 'sms_sender'],
                'optional_fields' => [],
            ],
            'custom' => [
                'name' => 'Custom/Other', 
                'sandbox' => false, 
                'description' => 'Custom API integration',
                'required_fields' => ['sms_api_url'],
                'optional_fields' => ['sms_api_key', 'sms_username', 'sms_password', 'sms_sender', 'sms_gateway'],
            ],
        ];
        
        return view('admin.otp-settings.index', compact('settings', 'smsPackages'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email_enabled' => ['nullable','boolean'],
            'sms_enabled' => ['nullable','boolean'],
            'length' => ['required','integer','min:4','max:8'],
            'ttl_minutes' => ['required','integer','min:1','max:60'],
            'max_attempts' => ['required','integer','min:1','max:10'],
            'sms_package' => ['nullable','string','in:laravel_bdsms,twilio,vonage,messagebird,aws_sns,clickatell,plivo,custom'],
            'sandbox_mode' => ['nullable','boolean'],
            'sms_gateway' => ['nullable','string','max:100'],
            'sms_masking' => ['nullable','string','max:50'],
            'sms_api_url' => ['nullable','string','max:255'],
            'sms_api_key' => ['nullable','string','max:255'],
            'sms_username' => ['nullable','string','max:255'],
            'sms_password' => ['nullable','string','max:255'],
            'sms_sender' => ['nullable','string','max:100'],
        ]);
        $settings = OtpSetting::get();
        $settings->update([
            'email_enabled' => $request->boolean('email_enabled'),
            'sms_enabled' => $request->boolean('sms_enabled'),
            'length' => $data['length'],
            'ttl_minutes' => $data['ttl_minutes'],
            'max_attempts' => $data['max_attempts'],
            'sms_package' => $data['sms_package'] ?? null,
            'sandbox_mode' => $request->boolean('sandbox_mode'),
            'sms_gateway' => $data['sms_gateway'] ?? null,
            'sms_masking' => $data['sms_masking'] ?? null,
            'sms_api_url' => $data['sms_api_url'] ?? null,
            'sms_api_key' => $data['sms_api_key'] ?? null,
            'sms_username' => $data['sms_username'] ?? null,
            'sms_password' => $data['sms_password'] ?? null,
            'sms_sender' => $data['sms_sender'] ?? null,
        ]);
        return back()->with('success','OTP settings updated.');
    }
}
