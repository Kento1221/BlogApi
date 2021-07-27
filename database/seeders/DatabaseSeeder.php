<?php

namespace Database\Seeders;

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
         $this->call([
             UsersTableSeeder::class, 
             LikeTypeSeeder::class
         ]);

         \App\Models\Author::factory()->count(5)->create();
         \App\Models\Tag::factory(10)->create();
         \App\Models\Category::factory(10)->create();
         \App\Models\Article::factory(50)->create();
         
        $this->call([
            ArticleTagSeeder::class
        ]);
    }
}
