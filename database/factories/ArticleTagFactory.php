<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $table = 'article_tag';

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'article_id'=>\App\Models\Article::inRandomOrder()-first(),
            'tag_id'=>\App\Models\Tag::inRandomOrder()->first(),
        ];
    }
}
