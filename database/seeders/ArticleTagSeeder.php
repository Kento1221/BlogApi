<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = \App\Models\Article::all();
        foreach($articles as $article){
         \DB::table('article_tag')->insert(
                [
                    'article_id'=>$article->id,
                    'tag_id'=>\App\Models\Tag::inRandomOrder()->first()->id,
                ]
            );
         }
    }
}
