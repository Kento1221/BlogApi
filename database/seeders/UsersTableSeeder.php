<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Kamil',
            'surname' => 'Orkisz',
            'email' => 'kamilorkisz@test.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->count(15)->create();

    }
}
