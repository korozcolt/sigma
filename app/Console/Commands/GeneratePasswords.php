<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Votation;

class GeneratePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate 250 unique passwords with 10 random digits';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $passwords = [];
        $count = 250;

        while ($count > 0) {
            $password = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            if (!in_array($password, $passwords)) {
                $passwords[] = $password;
                $count--;
            }
        }

        $this->info('Generated 250 unique passwords.');

        // Ahora puedes guardar los passwords en el modelo Votations
        foreach ($passwords as $password) {
            Votation::create(['password' => $password]);
        }

        return 1;
    }
}
