<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductImage;

class MigrateProductImages extends Command
{
    protected $signature = 'products:migrate-images';
    protected $description = 'Move old product image to product_images table';

    public function handle()
    {
        $products = Product::whereNotNull('video_url')->get();

        foreach ($products as $product) {

            // already migrated check
            if ($product->images()->exists()) {
                continue;
            }

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $product->video_url,
                'is_default' => 1
            ]);

            // ✅ CLEAR OLD COLUMN
            $product->update([
                'video_url' => null
            ]);

            $this->info("Migrated product ID: " . $product->id);
        }

        $this->info('Migration completed!');
    }
}