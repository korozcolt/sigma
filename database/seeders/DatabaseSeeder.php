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

        $place = \App\Models\Place::create([
            'place' => 'Casa de la Cultura',
            'table' => '1',
        ]);

        //create coordinator with $user->id
        $coordinator = \App\Models\Coordinator::create([
            'dni' => '1102812122',
            'first_name' => 'Kristian',
            'last_name' => 'Orozco',
            'phone' => '3016859339',
            'address' => '3016859339',
            'type' => 'Administrator',
            'status' => 'revisado',
            'debate_boss' => 'Administrator',
            'candidate' => 'Administrator',
            'place_id' => $place->id,
            'user_id' => $user->id,
        ]);

        $leader = \App\Models\Leader::create([
            'dni' => '1102812122',
            'first_name' => 'Kristian',
            'last_name' => 'Orozco',
            'phone' => '3016859339',
            'address' => '3016859339',
            'type' => 'Administrator',
            'status' => 'revisado',
            'debate_boss' => 'Administrator',
            'candidate' => 'Administrator',
            'place_id' => $place->id,
            'user_id' => $user->id,
            'coordinator_id' => $coordinator->id,
        ]);

        \App\Models\Voter::create([
            'dni' => '1102812122',
            'first_name' => 'Kristian',
            'last_name' => 'Orozco',
            'phone' => '3016859339',
            'address' => '3016859339',
            'type' => 'Administrator',
            'status' => 'revisado',
            'debate_boss' => 'Administrator',
            'candidate' => 'Administrator',
            'place_id' => $place->id,
            'leader_id' => $leader->id,
        ]);

        $contacts = \App\Models\Voter::first();
        $message = 'Tu usuario es: ' . $user->email . ' y tu contraseña es: Q@10op29+';
        Helper::sendSms($contacts, $message);

        $this->call([PlaceSeeder::class]);
        $this->call([ExternalNumbersSeeder::class]);
    }
}
