<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Helpers\Helper;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'ing.korozco@gmail.com',
            'password' => 'Q@10op29+',
            'role' => 'super_admin',
        ]);


        $this->call([PlaceSeeder::class]);
        $this->call([ExternalNumbersSeeder::class]);
        $this->call([VotationsSeeder::class]);
        $this->call([RelationsSeeder::class]);
    }
}
