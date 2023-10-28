<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class RelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws UnavailableStream|Exception
     * @throws Exception
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('seeders/data/VOTANTES.csv'), 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');
        if(!file_exists(database_path('seeders/data/VOTANTES.csv'))){
            dump('No existe el archivo');
            return;
        }
        foreach ($csv as $record) {
            try {
                \App\Models\Relation::create([
                    'cedula' => $record['cedula'],
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                dump($e->getMessage());
                dump($record);
                continue;
            }
        }
    }
}
