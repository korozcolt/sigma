<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class ExternalNumbersSeeder extends Seeder
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
        $csv = Reader::createFromPath(database_path('seeders/data/SUCRE-2.csv'), 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(';');

        foreach ($csv as $record) {
            try {
                \App\Models\ExternalNumber::create([
                    'cedula' => $record['cedula'],
                    'departamento' => $record['departamento'],
                    'municipio' => $record['municipio'],
                    'puesto' => $record['puesto'],
                    'mesa' => $record['mesa'],
                    'nombre_completo'=>''
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                dump($e->getMessage());
                dump($record);
                continue;
            }
        }
    }
}
