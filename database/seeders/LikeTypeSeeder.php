<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('likes')->insert([
            'type' => 'like',
        ]);
        \DB::table('likes')->insert([
            'type' => 'dislike',
        ]);
        \DB::table('likes')->insert([
            'type' => 'sad',
        ]);
        \DB::table('likes')->insert([
            'type' => 'funny',
        ]);
    }
}
