<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'ing.korozco@gmail.com',
            'password' => bcrypt('Q@10op29+'),
            'role' => 'super_admin',
        ]);

        //create coordinator with $user->id
        \App\Models\Coordinator::create([
            'dni' => '1102812122',
            'first_name' => 'Kristian',
            'last_name' => 'Orozco',
            'phone' => '12345678',
            'address' => '3016859339',
            'type' => 'Administrator',
            'status' => 'active',
            'debate_boss' => 'Administrator',
            'candidate' => 'Administrator',
            'place_id' => 1,
            'user_id' => $user->id,
        ]);

    }
}
