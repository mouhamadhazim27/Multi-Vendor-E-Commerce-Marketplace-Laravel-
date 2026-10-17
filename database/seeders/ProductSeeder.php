<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = Store::all();
        $categories = Categories::all();

        if ($stores->isEmpty()) {
            $this->command->warn(
                'No stores found. Run StoreSeeder first.'
            );
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->warn(
                'No categories found. Run CategorySeeder first.'
            );
            return;
        }

        Products::factory()
            ->count(10)
            ->make()
            ->each(function ($product) use ($stores, $categories) {

                // Assign a random store
                $product->store_id = $stores->random()->id;
                $product->save();

                // Assign 1 to 3 random categories
                $categoryIds = $categories
                    ->random(fake()->numberBetween(
                        1,
                        min(3, $categories->count())
                    ))
                    ->pluck('id')
                    ->all();

                $product->categories()->sync($categoryIds);
            });
    }
}
