<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\NewsletterSubscriber;

class NewsletterWelcome extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscriber;

    public function __construct(NewsletterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $siteSettings = \App\Models\SiteSetting::get();
        
        return (new MailMessage)
            ->subject('Welcome to Our Newsletter!')
            ->view('frontend.emails.newsletter.welcome', [
                'subscriber' => $this->subscriber,
                'siteName' => $siteSettings->site_name ?? 'Our Store',
                'siteUrl' => url('/'),
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'subscriber_id' => $this->subscriber->id,
        ];
    }
}

