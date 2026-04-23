<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpCodeNotification extends Notification
{
    use Queueable;

    public function __construct(public string $code, public $expiresAt)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $siteSettings = \App\Models\SiteSetting::get();
        
        return (new MailMessage)
            ->subject('Your Verification Code')
            ->view('frontend.emails.otp.code', [
                'code' => $this->code,
                'expiresAt' => $this->expiresAt,
                'siteName' => $siteSettings->site_name ?? 'eCommerce Store',
                'siteUrl' => url('/'),
                'siteSettings' => $siteSettings,
                'headerSubtitle' => 'Verification Code',
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,
            'expires_at' => $this->expiresAt,
        ];
    }
}
