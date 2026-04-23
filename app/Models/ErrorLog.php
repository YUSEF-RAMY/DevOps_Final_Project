<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'type', 'message', 'file', 'line', 'url', 'method', 'trace', 'context', 'user_type', 'user_id', 'is_resolved',
    ];

    protected $casts = [
        'line' => 'integer',
        'is_resolved' => 'boolean',
    ];

    public static function severityFromType(?string $type): string
    {
        if (!$type) return 'low';
        $t = strtolower($type);
        if (str_contains($t, 'exception')) return 'critical';
        if (str_contains($t, 'error')) return 'high';
        if (str_contains($t, 'warning')) return 'medium';
        return 'low';
    }
}
