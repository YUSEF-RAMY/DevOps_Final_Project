<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $siteSettings = \App\Models\SiteSetting::get();
        
        return (new MailMessage)
            ->subject('Welcome to ' . ($siteSettings->site_name ?? 'Our Store'))
            ->view('frontend.emails.auth.welcome', [
                'user' => $this->user,
                'siteName' => $siteSettings->site_name ?? 'Our Store',
                'siteUrl' => url('/'),
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id,
        ];
    }
}

