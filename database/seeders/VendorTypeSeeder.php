<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorType;

class VendorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Business Types
        $business = ['Manufacturer', 'Supplier', 'Service Provider', 'Logistics'];

        foreach ($business as $item) {
            VendorType::create([
                'name' => $item,
                'type' => 'business'
            ]);
        }

        // Categories
        $categories = ['Drinkware', 'Tech Gadgets', 'Packaging', 'Leather', 'Stationery'];

        foreach ($categories as $item) {
            VendorType::create([
                'name' => $item,
                'type' => 'category'
            ]);
        }
    }
}
