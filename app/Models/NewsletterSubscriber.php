<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'name', 'status', 'source', 'token', 'subscribed_at', 'unsubscribed_at'
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->token)) {
                $model->token = Str::uuid();
            }
            if ($model->status === 'subscribed' && empty($model->subscribed_at)) {
                $model->subscribed_at = now();
            }
        });
    }

    public function scopeSubscribed($query)
    {
        return $query->where('status', 'subscribed');
    }
}
