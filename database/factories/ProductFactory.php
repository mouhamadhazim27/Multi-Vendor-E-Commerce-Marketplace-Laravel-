<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Products::class;

    public function definition(): array
    {
        return [
            'product_name' => fake()->unique()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 5, 1000),
            'quantity_in_stock' => fake()->numberBetween(0, 100),
            'image_product' => 'products/default.jpg',
            'store_id' => null,
        ];
    }
}
