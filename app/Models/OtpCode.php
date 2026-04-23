<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel','identifier','code','purpose','expires_at','used_at','attempts','ip_address'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public function otptable()
    {
        return $this->morphTo();
    }
}
