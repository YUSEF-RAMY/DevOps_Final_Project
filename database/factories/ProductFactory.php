<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $price = $this->faker->randomFloat(2, 5, 300);
        return [
            'category_id' => null, // set in seeder
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'sku' => strtoupper(Str::random(8)),
            'short_description' => $this->faker->sentence(12),
            'description' => $this->faker->paragraph(4),
            'price' => $price,
            'compare_at_price' => $this->faker->boolean(30) ? $price + $this->faker->randomFloat(2, 1, 50) : null,
            'stock' => $this->faker->numberBetween(0, 200),
            'is_active' => $this->faker->boolean(90),
            'is_featured' => $this->faker->boolean(20),
            'meta_title' => null,
            'meta_description' => null,
        ];
    }
}
