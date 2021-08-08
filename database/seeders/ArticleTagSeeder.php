<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $articles = Article::all();

        foreach ($articles as $article) {
            $tag_number = rand(1, 5);
            $tags = Tag::inRandomOrder()->limit($tag_number)->pluck('id');
            $index_of_tag = 0;

            for ($i = 0; $i < $tag_number; $i++)
                $data[] = ['article_id' => $article->id, 'tag_id' => $tags[$index_of_tag++]];
        }
        DB::table('article_tag')->insert($data);
    }
}
