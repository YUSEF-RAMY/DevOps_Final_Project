<?php

namespace App\Support;

use App\Models\OtpCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OtpCodeNotification;
use Carbon\Carbon;
use App\Models\OtpSetting;

class OtpService
{
    public function generate(string $channel, string $identifier, string $purpose = 'login', ?int $length = null, ?int $ttlMinutes = null): OtpCode
    {
        $settings = OtpSetting::get();
        $len = $length ?? ($settings->length ?? 6);
        $ttl = $ttlMinutes ?? ($settings->ttl_minutes ?? 10);
        $code = str_pad((string) random_int(0, (10 ** $len) - 1), $len, '0', STR_PAD_LEFT);
        $otp = OtpCode::create([
            'channel' => $channel,
            'identifier' => $identifier,
            'code' => $code,
            'purpose' => $purpose,
            'expires_at' => now()->addMinutes($ttl),
            'ip_address' => request()->ip(),
        ]);
        return $otp;
    }

    public function sendEmail(OtpCode $otp): void
    {
        try {
            $settings = OtpSetting::get();
            if (!$settings->email_enabled) {
                throw new \Exception('Email OTP is disabled in settings');
            }
            Notification::route('mail', $otp->identifier)->notify(new OtpCodeNotification($otp->code, $otp->expires_at));
        } catch (\Throwable $e) {
            \Log::error('Email OTP send failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function sendSms(OtpCode $otp, ?array $config = null): bool
    {
        try {
            $settings = OtpSetting::get();
            
            // Check if SMS OTP is enabled
            if (!$settings->sms_enabled) {
                \Log::warning('SMS OTP send attempted but SMS is disabled in settings');
                return false;
            }
            
            $package = $settings->sms_package ?? 'laravel_bdsms'; // Default to Laravel BDSMS
            $sandboxMode = $settings->sandbox_mode ?? false;
            
            $message = "Your OTP is {$otp->code}. Valid till " . $otp->expires_at->format('H:i');
            $phoneNumber = $otp->identifier;
            
            // Remove any non-numeric characters except + for international numbers
            $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);
            
            switch ($package) {
                case 'laravel_bdsms':
                    return $this->sendViaLaravelBDSms($phoneNumber, $message, $settings, $config);
                    
                case 'twilio':
                    return $this->sendViaTwilio($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'vonage':
                    return $this->sendViaVonage($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'messagebird':
                    return $this->sendViaMessageBird($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'aws_sns':
                    return $this->sendViaAwsSns($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'clickatell':
                    return $this->sendViaClickatell($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'plivo':
                    return $this->sendViaPlivo($phoneNumber, $message, $settings, $sandboxMode);
                    
                case 'custom':
                    return $this->sendViaCustom($phoneNumber, $message, $settings);
                    
                default:
                    // Fallback to Laravel BDSMS if package not recognized
                    return $this->sendViaLaravelBDSms($phoneNumber, $message, $settings, $config);
            }
        } catch (\Throwable $e) {
            \Log::error('SMS OTP send failed: ' . $e->getMessage(), [
                'package' => $settings->sms_package ?? 'unknown',
                'phone' => $otp->identifier,
                'trace' => $e->getTraceAsString(),
            ]);
        }
        return false;
    }
    
    /**
     * Send SMS via Laravel BDSMS (Xenon)
     */
    private function sendViaLaravelBDSms(string $phoneNumber, string $message, OtpSetting $settings, ?array $config = null): bool
    {
        if (!class_exists('Xenon\\LaravelBDSms\\LaravelBDSms')) {
            \Log::error('Laravel BDSMS package not installed. Run: composer require xenon/laravel-bdsms');
            return false;
        }
        
        try {
            $sms = new \Xenon\LaravelBDSms\LaravelBDSms();
            $sms->setTo($phoneNumber)
                ->setText($message)
                ->setTemplate(null)
                ->setMasking($config['masking'] ?? $settings->sms_masking ?? '')
                ->setGateway($config['gateway'] ?? $settings->sms_gateway ?? 'mim_sms')
                ->send();
            return true;
        } catch (\Throwable $e) {
            \Log::error('Laravel BDSMS send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via Twilio
     */
    private function sendViaTwilio(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        if (!class_exists('Twilio\\Rest\\Client')) {
            \Log::error('Twilio SDK not installed. Run: composer require twilio/sdk');
            return false;
        }
        
        try {
            $accountSid = $sandboxMode ? ($settings->sms_username ?? env('TWILIO_TEST_SID')) : ($settings->sms_username ?? env('TWILIO_SID'));
            $authToken = $sandboxMode ? ($settings->sms_password ?? env('TWILIO_TEST_TOKEN')) : ($settings->sms_password ?? env('TWILIO_TOKEN'));
            $fromNumber = $settings->sms_sender ?? env('TWILIO_FROM');
            
            if (empty($accountSid) || empty($authToken) || empty($fromNumber)) {
                \Log::error('Twilio credentials not configured');
                return false;
            }
            
            $client = new \Twilio\Rest\Client($accountSid, $authToken);
            $client->messages->create($phoneNumber, [
                'from' => $fromNumber,
                'body' => $message,
            ]);
            return true;
        } catch (\Throwable $e) {
            \Log::error('Twilio send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via Vonage (Nexmo)
     */
    private function sendViaVonage(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        if (!class_exists('Vonage\\Client')) {
            \Log::error('Vonage SDK not installed. Run: composer require vonage/client-core');
            return false;
        }
        
        try {
            $apiKey = $settings->sms_api_key ?? env('VONAGE_API_KEY');
            $apiSecret = $settings->sms_password ?? env('VONAGE_API_SECRET');
            $from = $settings->sms_sender ?? env('VONAGE_SMS_FROM');
            
            if (empty($apiKey) || empty($apiSecret) || empty($from)) {
                \Log::error('Vonage credentials not configured');
                return false;
            }
            
            $client = new \Vonage\Client(new \Vonage\Client\Credentials\Basic($apiKey, $apiSecret));
            $sms = new \Vonage\SMS\Message\SMS($phoneNumber, $from, $message);
            $client->sms()->send($sms);
            return true;
        } catch (\Throwable $e) {
            \Log::error('Vonage send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via MessageBird
     */
    private function sendViaMessageBird(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        if (!class_exists('MessageBird\\Client')) {
            \Log::error('MessageBird SDK not installed. Run: composer require messagebird/php-rest-api');
            return false;
        }
        
        try {
            $apiKey = $settings->sms_api_key ?? env('MESSAGEBIRD_API_KEY');
            $originator = $settings->sms_sender ?? env('MESSAGEBIRD_ORIGINATOR');
            
            if (empty($apiKey) || empty($originator)) {
                \Log::error('MessageBird credentials not configured');
                return false;
            }
            
            $client = new \MessageBird\Client($apiKey);
            $messageObj = new \MessageBird\Objects\Message();
            $messageObj->originator = $originator;
            $messageObj->recipients = [$phoneNumber];
            $messageObj->body = $message;
            
            $client->messages->create($messageObj);
            return true;
        } catch (\Throwable $e) {
            \Log::error('MessageBird send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via AWS SNS
     */
    private function sendViaAwsSns(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        if (!class_exists('Aws\\Sns\\SnsClient')) {
            \Log::error('AWS SDK not installed. Run: composer require aws/aws-sdk-php');
            return false;
        }
        
        try {
            $key = $settings->sms_api_key ?? env('AWS_ACCESS_KEY_ID');
            $secret = $settings->sms_password ?? env('AWS_SECRET_ACCESS_KEY');
            $region = $settings->sms_api_url ?? env('AWS_DEFAULT_REGION', 'us-east-1');
            
            if (empty($key) || empty($secret)) {
                \Log::error('AWS credentials not configured');
                return false;
            }
            
            $sns = new \Aws\Sns\SnsClient([
                'version' => 'latest',
                'region' => $region,
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
            ]);
            
            $sns->publish([
                'PhoneNumber' => $phoneNumber,
                'Message' => $message,
            ]);
            return true;
        } catch (\Throwable $e) {
            \Log::error('AWS SNS send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via Clickatell
     */
    private function sendViaClickatell(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        try {
            $apiKey = $settings->sms_api_key ?? env('CLICKATELL_API_KEY');
            $apiUrl = $settings->sms_api_url ?? 'https://platform.clickatell.com/messages/http/send';
            
            if (empty($apiKey)) {
                \Log::error('Clickatell API key not configured');
                return false;
            }
            
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'to' => [$phoneNumber],
                'content' => $message,
            ]);
            
            return $response->successful();
        } catch (\Throwable $e) {
            \Log::error('Clickatell send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via Plivo
     */
    private function sendViaPlivo(string $phoneNumber, string $message, OtpSetting $settings, bool $sandboxMode): bool
    {
        if (!class_exists('Plivo\\RestClient')) {
            \Log::error('Plivo SDK not installed. Run: composer require plivo/plivo-php');
            return false;
        }
        
        try {
            $authId = $settings->sms_username ?? env('PLIVO_AUTH_ID');
            $authToken = $settings->sms_password ?? env('PLIVO_AUTH_TOKEN');
            $from = $settings->sms_sender ?? env('PLIVO_FROM');
            
            if (empty($authId) || empty($authToken) || empty($from)) {
                \Log::error('Plivo credentials not configured');
                return false;
            }
            
            $client = new \Plivo\RestClient($authId, $authToken);
            $client->messages->create($from, [$phoneNumber], $message);
            return true;
        } catch (\Throwable $e) {
            \Log::error('Plivo send failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send SMS via Custom API
     */
    private function sendViaCustom(string $phoneNumber, string $message, OtpSetting $settings): bool
    {
        try {
            $apiUrl = $settings->sms_api_url;
            $apiKey = $settings->sms_api_key;
            $username = $settings->sms_username;
            $password = $settings->sms_password;
            
            if (empty($apiUrl)) {
                \Log::error('Custom SMS API URL not configured');
                return false;
            }
            
            $payload = [
                'to' => $phoneNumber,
                'message' => $message,
            ];
            
            if ($settings->sms_sender) {
                $payload['from'] = $settings->sms_sender;
            }
            
            $headers = [];
            if ($apiKey) {
                $headers['Authorization'] = 'Bearer ' . $apiKey;
            } elseif ($username && $password) {
                $headers['Authorization'] = 'Basic ' . base64_encode($username . ':' . $password);
            }
            
            $response = \Illuminate\Support\Facades\Http::withHeaders($headers)->post($apiUrl, $payload);
            return $response->successful();
        } catch (\Throwable $e) {
            \Log::error('Custom SMS send failed: ' . $e->getMessage());
            return false;
        }
    }

    public function verify(string $channel, string $identifier, string $code, string $purpose = 'login'): bool
    {
        $otp = OtpCode::where('channel', $channel)
            ->where('identifier', $identifier)
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->orderByDesc('id')
            ->first();

        if (!$otp) {
            return false;
        }

        // Expiry
        if ($otp->expires_at->isPast()) {
            return false;
        }

        // Attempts rate limiting simple
        $maxAttempts = (OtpSetting::get()->max_attempts ?? 5);
        if ($otp->attempts >= $maxAttempts) {
            return false;
        }

        $otp->increment('attempts');

        if (hash_equals($otp->code, $code)) {
            $otp->used_at = now();
            $otp->save();
            return true;
        }

        return false;
    }
}
