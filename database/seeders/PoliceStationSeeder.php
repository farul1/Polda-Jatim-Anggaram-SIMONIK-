<?php

namespace Database\Seeders;

use App\Models\PoliceStation;
use Illuminate\Database\Seeder;

class PoliceStationSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        PoliceStation::query()->delete();

        $csvFile = fopen(database_path("seeders/data_kantor_surabaya.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                PoliceStation::create([
                    "name" => $data['0'],
                    "address" => $data['1'],
                    "city" => $data['2'],
                    "phone_number" => $data['3'],
                    "latitude" => $data['4'],
                    "longitude" => $data['5']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

