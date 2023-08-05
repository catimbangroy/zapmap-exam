<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::truncate();

        $csvFile = fopen(base_path("database/data/data.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                Location::create([
                    "name" => $data['0'],
                    "latitude" => $data['1'],
                    "longitude" => $data['2']
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
