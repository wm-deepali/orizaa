<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GiftingOccasion;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ImportOccasions extends Command
{
    protected $signature = 'import:occasions';
    protected $description = 'Import gifting occasions';

    public function handle()
    {
        $file = base_path('tab_occassions.csv');

        if (!file_exists($file)) {
            $this->error('❌ CSV not found');
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $this->info('🚀 Importing occasions...');

        while (($row = fgetcsv($handle)) !== false) {

            // =========================
            // 🔁 MAPPING
            // =========================
            $oldId       = $row[0];
            $title       = $row[1];
            $description = $row[2];
            $sortOrder   = $row[3]; // optional
            $imageName   = $row[4];

            // =========================
            // 🖼 IMAGE LOGIC
            // =========================
            $imagePath = null;

            $sourceFolder = base_path("occasion/{$oldId}");

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

                        $imagePath = $uploadedFile->store('gifting', 'public');
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

                            $imagePath = $uploadedFile->store('occasions', 'public');
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
            GiftingOccasion::create([
                'old_id' => $oldId, // 🔥 IMPORTANT

                'title' => $title,
                'slug' => Str::slug($title . '-' . $oldId),

                'sub_title' => $description,
                'short_description' => $description,

                'image' => $imagePath,
                'status' => 1
            ]);

            $this->info("✅ Imported: {$title}");
        }

        fclose($handle);

        $this->info('🎉 Done!');
    }
}