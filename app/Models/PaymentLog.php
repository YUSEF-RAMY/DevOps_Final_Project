<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway',
        'action',
        'data',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get logs for a specific gateway
     */
    public static function getGatewayLogs(string $gateway, int $limit = 50)
    {
        return self::where('gateway', $gateway)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get logs for a specific action
     */
    public static function getActionLogs(string $action, int $limit = 50)
    {
        return self::where('action', $action)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent logs
     */
    public static function getRecentLogs(int $limit = 100)
    {
        return self::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
