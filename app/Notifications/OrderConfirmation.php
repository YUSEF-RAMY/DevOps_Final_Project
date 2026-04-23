<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $siteSettings = \App\Models\SiteSetting::get();
        $currency = \App\Support\CurrencyManager::getDefaultCurrency();
        
        // Load order items for email
        $this->order->load('items');
        
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Order Confirmation - ' . $this->order->number)
            ->view('frontend.emails.orders.confirmation', [
                'order' => $this->order,
                'siteName' => $siteSettings->site_name ?? 'eCommerce Store',
                'siteUrl' => url('/'),
                'currency' => $currency ? $currency->symbol : '৳',
                'siteSettings' => $siteSettings,
                'headerSubtitle' => 'Order Confirmation',
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->number,
            'total' => $this->order->grand_total,
        ];
    }
}