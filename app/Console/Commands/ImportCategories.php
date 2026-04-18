<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ImportCategories extends Command
{
    protected $signature = 'import:categories';
    protected $description = 'Import categories from CSV with images';

    public function handle()
    {
        $file = base_path('tab_category.csv');

        if (!file_exists($file)) {
            $this->error('❌ CSV file not found in root');
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $oldToNewIds = [];

        $this->info('🚀 Import Started...');

        while (($row = fgetcsv($handle)) !== false) {

            // =========================
            // 🔁 COLUMN MAPPING
            // =========================
            $oldId = $row[0];
            $name = $row[1];
            $description = $row[2];
            $imageName = $row[4];
            $addedBy = $row[5] ?? 'Admin';
            $isSub = $row[6];
            $parentId = $row[7];
            $isNew = $row[8];
            $isSpecial = $row[9];
            $status = $row[11];
            $showWebsite = $row[12];
            $delStatus = $row[13];

            // ❌ skip deleted
            if ($delStatus == 1) {
                continue;
            }

            // =========================
            // 🧠 PARENT MAPPING
            // =========================
            $newParentId = isset($oldToNewIds[$parentId])
                ? $oldToNewIds[$parentId]
                : null;

            // =========================
            // 🖼 IMAGE (FIXED LOGIC)
            // =========================
            $imagePath = null;

            $sourceFolder = base_path("category/{$oldId}");

            if (is_dir($sourceFolder)) {

                // ✅ 1. TRY exact image from CSV
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

                        $imagePath = $uploadedFile->store('categories', 'public');

                        $this->info("🖼 Exact image used: {$imageName}");
                    }
                }

                // ✅ 2. FALLBACK if not found
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

                            $imagePath = $uploadedFile->store('categories', 'public');

                            $this->warn("⚠️ Fallback image used: {$fileImg}");
                            break;
                        }
                    }
                }

            } else {
                $this->warn("⚠️ Folder missing: {$oldId}");
            }

            // =========================
            // ✅ INSERT
            // =========================
            $category = Category::create([
                'old_id' => $oldId, 
                'name' => $name,
                'slug' => Str::slug($name . '-' . $oldId),

                'sub_title' => $description,

                'parent_id' => $newParentId,
                'is_sub_category' => ($isSub == 'yes' || $isSub == 1) ? 1 : 0,

                'image' => $imagePath,

                'added_by' => $addedBy ?: 'Admin',

                'is_featured' => $isNew ? 1 : 0,
                'is_popular' => $isSpecial ? 1 : 0,

                'show_on_website' => $showWebsite ? 1 : 0,
                'status' => $status ? 1 : 0,
            ]);

            $oldToNewIds[$oldId] = $category->id;

            $this->info("✅ Imported: {$name}");
        }

        fclose($handle);

        $this->info('🎉 Import Completed!');
    }
}