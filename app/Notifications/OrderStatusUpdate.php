<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderStatusUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $message;

    public function __construct(Order $order, ?string $message = null)
    {
        $this->order = $order;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $siteSettings = \App\Models\SiteSetting::get();
        $currency = \App\Support\CurrencyManager::getDefaultCurrency();
        
        return (new MailMessage)
            ->subject('Order Status Update - ' . $this->order->number)
            ->view('frontend.emails.orders.status-update', [
                'order' => $this->order,
                'message' => $this->message,
                'siteName' => $siteSettings->site_name ?? 'eCommerce Store',
                'siteUrl' => url('/'),
                'currency' => $currency ? $currency->symbol : '৳',
                'siteSettings' => $siteSettings,
                'headerSubtitle' => 'Order Status Update',
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->number,
            'status' => $this->order->status,
        ];
    }
}

