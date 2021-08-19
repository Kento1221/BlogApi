<?php

namespace Database\Seeders;

use App\Models\Role ;
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
            'position' => 'Laravel Developer/Student',
            'role_id' => Role::IS_ADMIN,
            'email' => 'kamilorkisz@test.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->count(90)->create();
        \App\Models\User::factory()->count(8)->writer()->create();
        \App\Models\User::factory()->count(1)->admin()->create();

    }
}
