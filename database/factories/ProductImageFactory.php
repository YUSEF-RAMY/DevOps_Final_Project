<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => null, // set in seeder
            // Store relative path under public storage; actual file is created in seeder
            'path' => 'products/' . Str::uuid() . '.jpg',
            'position' => 0,
            'is_primary' => false,
        ];
    }
}
