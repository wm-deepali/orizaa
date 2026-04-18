<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class IndiaStateCitySeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('data/india.csv'), 'r');

        $headerSkipped = false;

        while (($row = fgetcsv($file, 1000, ",")) !== false) {

            // Skip header rows
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            // ⚠️ Adjust index based on your CSV
            $city = trim($row[1] ?? '');
            $state = trim($row[4] ?? '');

            if (empty($city) || empty($state)) {
                continue;
            }

            // Create or get state
            $stateModel = State::firstOrCreate([
                'name' => $state
            ]);

            // Create city
            City::firstOrCreate([
                'name' => $city,
                'state_id' => $stateModel->id
            ]);
        }

        fclose($file);
    }
}
