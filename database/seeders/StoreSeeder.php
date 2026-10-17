<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = User::where('role', 'vendor')->get();

        foreach ($vendors as $vendor) {
            Store::firstOrCreate(
                ['user_id' => $vendor->id],
                Store::factory()->make()->toArray()
            );
        }
    }
}
