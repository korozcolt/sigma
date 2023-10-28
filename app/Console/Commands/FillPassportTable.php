<?php

namespace App\Console\Commands;

use App\Models\Votation;
use Illuminate\Console\Command;
use App\Models\Passport;
use Illuminate\Support\Str;

class FillPassportTable extends Command
{
    protected $signature = 'passport:fill {count}';

    protected $description = 'Fill the Passport table with random data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = $this->argument('count');

        $distinctPlaces = Votation::distinct('nombre_puesto')->pluck('nombre_puesto');

        foreach ($distinctPlaces as $place) {
            for ($i = 1; $i <= $count; $i++) {
                Passport::create([
                    'password' => str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT), // Random 6-digit password
                    'token' => Str::random(40), // Random 40-character token (you can adjust the length)
                    'votation_leader' => $i,
                    'votation_place' => $place,
                    'votation_table' => 1,
                ]);
            }
        }

        $this->info("{$count} records added to the Passport table.");
    }
}
