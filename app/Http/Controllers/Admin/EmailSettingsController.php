<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmailSettingsController extends Controller
{
    public function index()
    {
        $settings = EmailSetting::all();
        
        // Detect cPanel SMTP settings if available
        $cpanelSmtp = $this->detectCpanelSmtp();
        
        // Get SMTP settings for the view
        $smtpSettings = [
            'enabled' => EmailSetting::get('smtp_enabled', '0') === '1',
            'host' => EmailSetting::get('smtp_host', ''),
            'port' => EmailSetting::get('smtp_port', '587'),
            'username' => EmailSetting::get('smtp_username', ''),
            'password' => EmailSetting::get('smtp_password', ''),
            'encryption' => EmailSetting::get('smtp_encryption', 'tls'),
            'from_address' => EmailSetting::get('smtp_from_address', ''),
            'from_name' => EmailSetting::get('smtp_from_name', ''),
        ];
        
        return view('admin.email-settings.index', compact('settings', 'cpanelSmtp', 'smtpSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($request->settings as $key => $value) {
            EmailSetting::set($key, $value ?? '');
        }
        
        // Update Laravel mail configuration if SMTP is enabled
        $smtpEnabled = EmailSetting::get('smtp_enabled', '0') === '1';
        if ($smtpEnabled) {
            $this->updateMailConfig();
        }

        return redirect()->route('admin.email-settings.index')
            ->with('success', 'Email settings updated successfully!');
    }
    
    /**
     * Detect cPanel SMTP settings from common locations
     */
    private function detectCpanelSmtp(): ?array
    {
        $smtp = null;
        
        // Check environment variables first (most reliable)
        if (env('MAIL_HOST') && env('MAIL_USERNAME')) {
            $smtp = [
                'host' => env('MAIL_HOST'),
                'port' => env('MAIL_PORT', '587'),
                'username' => env('MAIL_USERNAME'),
                'password' => env('MAIL_PASSWORD', ''),
                'encryption' => env('MAIL_ENCRYPTION', 'tls'),
                'from_address' => env('MAIL_FROM_ADDRESS', env('MAIL_USERNAME')),
                'from_name' => env('MAIL_FROM_NAME', ''),
                'source' => 'Environment Variables (.env file)',
            ];
        }
        
        // Check common cPanel locations
        if (!$smtp) {
            $cpanelPaths = [
                '/home/' . get_current_user() . '/.cpanel/email_accounts',
                '/usr/local/cpanel/version',
                base_path('.cpanel'),
            ];
            
            foreach ($cpanelPaths as $path) {
                if (File::exists($path)) {
                    // If cPanel is detected, try to get SMTP from common cPanel email config
                    $smtp = [
                        'host' => 'mail.' . parse_url(config('app.url'), PHP_URL_HOST),
                        'port' => '587',
                        'username' => '',
                        'password' => '',
                        'encryption' => 'tls',
                        'from_address' => '',
                        'from_name' => '',
                        'source' => 'cPanel Detected (manual configuration required)',
                    ];
                    break;
                }
            }
        }
        
        // Check if we're on a cPanel server by checking common indicators
        if (!$smtp) {
            $cpanelIndicators = [
                '/usr/local/cpanel',
                '/var/cpanel',
                function_exists('exec') && strpos(shell_exec('which cpanel 2>&1'), 'cpanel') !== false,
            ];
            
            $hasCpanel = false;
            foreach ($cpanelIndicators as $indicator) {
                if (is_string($indicator) && File::exists($indicator)) {
                    $hasCpanel = true;
                    break;
                } elseif (is_bool($indicator) && $indicator) {
                    $hasCpanel = true;
                    break;
                }
            }
            
            if ($hasCpanel) {
                $domain = parse_url(config('app.url'), PHP_URL_HOST);
                $smtp = [
                    'host' => 'mail.' . $domain,
                    'port' => '587',
                    'username' => '',
                    'password' => '',
                    'encryption' => 'tls',
                    'from_address' => '',
                    'from_name' => '',
                    'source' => 'cPanel Server Detected (suggested: mail.' . $domain . ')',
                ];
            }
        }
        
        return $smtp;
    }
    
    /**
     * Update Laravel mail configuration dynamically
     */
    private function updateMailConfig(): void
    {
        // Note: Laravel doesn't support runtime config changes that persist
        // This would need to update .env file or use a config cache
        // For now, we'll just ensure the settings are saved in the database
        // The application should read from EmailSetting model when sending emails
        
        // You can optionally update .env file here if needed
        // But it's better to use the database settings and apply them at runtime
    }
    
    /**
     * Send a test email to verify SMTP configuration
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);
        
        try {
            // Apply SMTP settings before sending
            $smtpEnabled = EmailSetting::get('smtp_enabled', '0') === '1';
            
            if ($smtpEnabled) {
                config(['mail.default' => 'smtp']);
                
                $host = EmailSetting::get('smtp_host');
                $port = EmailSetting::get('smtp_port');
                $username = EmailSetting::get('smtp_username');
                $password = EmailSetting::get('smtp_password');
                $encryption = EmailSetting::get('smtp_encryption', 'tls');
                $fromAddress = EmailSetting::get('smtp_from_address') ?: EmailSetting::get('smtp_username');
                $fromName = EmailSetting::get('smtp_from_name') ?: EmailSetting::get('from_name', 'eCommerce Store');

                if ($host) config(['mail.mailers.smtp.host' => $host]);
                if ($port) config(['mail.mailers.smtp.port' => (int) $port]);
                if ($username) config(['mail.mailers.smtp.username' => $username]);
                if ($password) config(['mail.mailers.smtp.password' => $password]);
                if ($encryption) config(['mail.mailers.smtp.encryption' => $encryption]);
                if ($fromAddress) config(['mail.from.address' => $fromAddress]);
                if ($fromName) config(['mail.from.name' => $fromName]);
            }
            
            // Send test email
            \Illuminate\Support\Facades\Mail::raw(
                "This is a test email from your eCommerce store.\n\n" .
                "SMTP Configuration:\n" .
                "Host: " . ($host ?? 'Not set') . "\n" .
                "Port: " . ($port ?? 'Not set') . "\n" .
                "Encryption: " . ($encryption ?? 'Not set') . "\n" .
                "From: " . ($fromAddress ?? 'Not set') . "\n\n" .
                "If you received this email, your SMTP configuration is working correctly!",
                function ($message) use ($request, $fromAddress, $fromName) {
                    $message->to($request->test_email)
                            ->subject('SMTP Test Email - eCommerce Store');
                    if ($fromAddress) {
                        $message->from($fromAddress, $fromName ?? 'eCommerce Store');
                    }
                }
            );
            
            return redirect()->route('admin.email-settings.index')
                ->with('success', 'Test email sent successfully to ' . $request->test_email . '! Please check your inbox.');
        } catch (\Exception $e) {
            \Log::error('Test email failed: ' . $e->getMessage());
            return redirect()->route('admin.email-settings.index')
                ->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }
}