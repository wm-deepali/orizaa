<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Product;

class InactivateEmptyCategories extends Command
{
    protected $signature = 'categories:sync-status';
    protected $description = 'Activate all categories/products and deactivate only those with empty names';

    public function handle()
    {
        // ✅ STEP 1: Make ALL active
        Category::query()->update(['status' => 1]);
        Product::query()->update(['status' => 1]);

        // ✅ STEP 2: Deactivate invalid categories
        $invalidCategories = Category::whereNull('name')
            ->orWhereRaw('TRIM(name) = ""')
            ->get();

        foreach ($invalidCategories as $cat) {
            $cat->update(['status' => 0]);
        }

        // ✅ STEP 3: Deactivate invalid products
        $invalidProducts = Product::whereNull('name')
            ->orWhereRaw('TRIM(name) = ""')
            ->get();

        foreach ($invalidProducts as $product) {
            $product->update(['status' => 0]);
        }

        $this->info('✅ All categories/products activated.');
        $this->info('⚠️ Empty name categories/products deactivated.');

        $this->info("Categories affected: " . $invalidCategories->count());
        $this->info("Products affected: " . $invalidProducts->count());
    }
}