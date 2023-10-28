<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class VotationsSeeder extends Seeder
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
        $csv = Reader::createFromPath(database_path('seeders/data/SUCRE-2023.csv'), 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');
        if(!file_exists(database_path('seeders/data/SUCRE-2023.csv'))){
            dump('No existe el archivo');
            return;
        }
        foreach ($csv as $record) {
            try {
                \App\Models\Votation::create([
                    'cedula' => $record['cedula'],
                    'zona' => $record['zona'],
                    'puesto' => $record['puesto'],
                    'mesa' => $record['mesa'],
                    'nombre_puesto' => $record['nombre_puesto'],
                    'municipio' => $record['municipio'],
                    'type'=>'none'
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                dump($e->getMessage());
                dump($record);
                continue;
            }
        }
    }
}
