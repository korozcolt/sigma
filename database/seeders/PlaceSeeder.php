<?php

namespace Database\Seeders;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;
use Illuminate\Support\Facades\File;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function run()
    {
        $json = File::get(database_path('seeders/data/places.json'));
        $data = json_decode($json);

        foreach ($data as $placeData) {
            Place::create([
                'place' => $placeData->place,
                'table' => $placeData->table,
            ]);
        }
    }
}
