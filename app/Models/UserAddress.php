<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'company',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'division',
        'district',
        'upazila',
        'postal_code',
        'country',
        'phone',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullAddressAttribute(): string
    {
        $address = $this->address_line_1;
        if ($this->address_line_2) {
            $address .= ', ' . $this->address_line_2;
        }
        if ($this->upazila) {
            $address .= ', ' . $this->upazila;
        }
        if ($this->district) {
            $address .= ', ' . $this->district;
        }
        if ($this->division) {
            $address .= ', ' . $this->division;
        }
        if ($this->postal_code) {
            $address .= ' ' . $this->postal_code;
        }
        if ($this->country) {
            $address .= ', ' . $this->country;
        }
        return $address;
    }
}