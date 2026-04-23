<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    protected $fillable = [
        'name',
        'division',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function upazilas(): HasMany
    {
        return $this->hasMany(Upazila::class)->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }

    public function allUpazilas(): HasMany
    {
        return $this->hasMany(Upazila::class)->orderBy('sort_order')->orderBy('name');
    }

    public static function getByDivision(string $division): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('division', $division)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}

