<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
            'store_name' => $storeName = fake()->company(),
            'store_slug' => Str::slug($storeName),
            'business_email' => fake()->unique()->companyEmail(),
            'business_type' => fake()->randomElement([
                'individual',
                'company',
            ]),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'store_logo' => null,
            'store_description' => fake()->paragraph(),
            'in_progress' => 'Approved',
        ];
    }
}
