<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class UpdateCategorySortOrder extends Command
{
    protected $signature = 'update:category-sort';
    protected $description = 'Update category sort_order using old_id from CSV';

    public function handle()
    {
        $file = base_path('tab_category.csv');

        if (!file_exists($file)) {
            $this->error('❌ CSV file not found');
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $this->info('🚀 Updating sort order...');

        while (($row = fgetcsv($handle)) !== false) {

            $oldId = $row[0];

            // 👉 CHANGE THIS INDEX based on your CSV
            $sortOrder = isset($row[10]) && is_numeric($row[10]) ? (int)$row[10] : 0;

            $category = Category::where('old_id', $oldId)->first();

            if ($category) {
                $category->update([
                    'sort_order' => $sortOrder
                ]);

                $this->info("✅ Updated: {$category->name} → Sort: {$sortOrder}");
            } else {
                $this->warn("⚠️ Not found for old_id: {$oldId}");
            }
        }

        fclose($handle);

        $this->info('🎉 Sort order update completed!');
    }
}