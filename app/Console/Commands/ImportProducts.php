<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use App\Models\GiftingOccasion;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ImportProducts extends Command
{
    protected $signature = 'import:products';
    protected $description = 'Import products with category, subcategory, occasion';

    public function handle()
    {
        $file = base_path('tab_product.csv');

        if (!file_exists($file)) {
            $this->error('❌ CSV not found');
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $this->info('🚀 Product import started...');

        while (($row = fgetcsv($handle)) !== false) {

            // =========================
            // 🔁 MAPPING
            // =========================
            $oldId = isset($row[0]) && is_numeric($row[0]) ? (int) $row[0] : null;

            $productCode = !empty($row[1]) ? trim($row[1]) : null;

            $title = !empty($row[2]) ? trim($row[2]) : 'Untitled Product';

            $categoryId = isset($row[3]) && is_numeric($row[3]) ? (int) $row[3] : null;

            $description = !empty($row[4]) ? trim($row[4]) : null;

            $price = isset($row[5]) && is_numeric($row[5]) ? (float) $row[5] : 0;

            $discount = isset($row[6]) && is_numeric($row[6]) ? (float) $row[6] : 0;

            // ✅ BOOLEAN FLAGS (safe)
            $isSpecial = !empty($row[7]) ? (int) $row[7] : 0;
            $isNew = !empty($row[8]) ? (int) $row[8] : 0;
            $isPremium = !empty($row[9]) ? (int) $row[9] : 0;
            $isEngraving = !empty($row[10]) ? (int) $row[10] : 0;

            $status = isset($row[11]) ? (int) $row[11] : 1;
            $showWebsite = isset($row[12]) ? (int) $row[12] : 1;

            // ✅ IMAGE
            $imageName = !empty($row[24]) ? trim($row[24]) : null;

            // ✅ STRING SAFE
            $addedBy = !empty($row[25]) ? trim($row[25]) : 'Admin';

            // ✅ BOOLEAN
            $bestSeller = !empty($row[26]) ? (int) $row[26] : 0;

            // ✅ INTEGER SAFE
            $brandId = isset($row[27]) && $row[27] !== '' && is_numeric($row[27]) ? (int) $row[27] : null;

            $sortOrder = isset($row[28]) && $row[28] !== '' && is_numeric($row[28]) ? (int) $row[28] : null;

            $occasionId = isset($row[29]) && $row[29] !== '' && is_numeric($row[29]) ? (int) $row[29] : null;

            // =========================
            // 🖼 IMAGE LOGIC
            // =========================
            $imagePath = null;

            $sourceFolder = base_path("category/{$categoryId}/{$oldId}");

            if (is_dir($sourceFolder)) {

                // try exact image
                if (!empty($imageName)) {

                    $exactPath = $sourceFolder . '/' . $imageName;

                    if (file_exists($exactPath)) {

                        $uploadedFile = new UploadedFile(
                            $exactPath,
                            $imageName,
                            null,
                            null,
                            true
                        );

                        $imagePath = $uploadedFile->store('products', 'public');
                    }
                }

                // fallback
                if (!$imagePath) {

                    $files = array_diff(scandir($sourceFolder), ['.', '..']);

                    foreach ($files as $fileImg) {

                        if (!preg_match('/\.(jpg|jpeg|png|webp)$/i', $fileImg)) {
                            continue;
                        }

                        $source = $sourceFolder . '/' . $fileImg;

                        if (file_exists($source)) {

                            $uploadedFile = new UploadedFile(
                                $source,
                                $fileImg,
                                null,
                                null,
                                true
                            );

                            $imagePath = $uploadedFile->store('products', 'public');
                            break;
                        }
                    }
                }

            } else {
                $this->warn("⚠️ Image folder missing: {$oldId}");
            }

            $mrp = (float) $price;
            $discountValue = (float) $discount;

            // 🔥 AUTO DETECT TYPE
            if ($discountValue > 0 && $discountValue <= 100) {
                $discountType = 'percentage';

                $finalPrice = $mrp - (($mrp * $discountValue) / 100);
            } else {
                $discountType = 'amount';

                $finalPrice = $mrp - $discountValue;
            }

            // safety
            if ($finalPrice < 0) {
                $finalPrice = $mrp;
            }

            // =========================
            // ✅ CREATE PRODUCT
            // =========================
            $product = Product::create([
                'old_id' => $oldId,

                'name' => $title,
                'slug' => Str::slug($title . '-' . $oldId),

                'summary' => $description,
                'details' => $description,

                'product_code' => $productCode,
                'brand_id' => $brandId,
                'added_by' => $addedBy,
                'sort_order' => $sortOrder,

                'mrp' => $mrp,
                'price' => $finalPrice,
                'discount' => $discountValue,
                'discount_type' => $discountType,

                'featured' => $isSpecial ? 1 : 0,
                'new_arrival' => $isNew ? 1 : 0,
                'best_seller' => $bestSeller ? 1 : 0,

                'is_premium' => $isPremium ? 1 : 0,
                'is_engraving' => $isEngraving ? 1 : 0,

                'show_on_website' => $showWebsite ? 1 : 0,
                'status' => $status ? 1 : 0,

                'image' => $imagePath,
            ]);

            // =========================
            // 🔗 CATEGORY / SUBCATEGORY
            // =========================
            $category = Category::where('old_id', $categoryId)->first();

            if ($category) {

                if ($category->parent_id == null) {
                    // MAIN CATEGORY
                    $product->categories()->attach($category->id);
                } else {
                    // SUBCATEGORY
                    $product->subcategories()->attach($category->id);
                }

            } else {
                $this->warn("⚠️ Category not found: {$categoryId}");
            }

            // =========================
            // 🎯 OCCASION
            // =========================
            if ($occasionId) {

                $occasion = GiftingOccasion::where('old_id', $occasionId)->first();

                if ($occasion) {
                    $product->occasions()->attach($occasion->id);
                }
            }

            $this->info("✅ Imported: {$title}");
        }

        fclose($handle);

        $this->info('🎉 Product import completed!');
    }
}