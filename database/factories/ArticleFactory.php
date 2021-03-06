<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>\App\Models\User::inRandomOrder()->first(),
            'slug'=>$this->faker->unique()->slug,
            'title'=>$this->faker->sentence,
            'image_url'=>'https://images.unsplash.com/photo-1624555130581-1d9cca783bc0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1051&q=80',
            'body'=>$this->faker->sentence(5),
            'category_id'=>\App\Models\Category::inRandomOrder()->first(),
            'published_at'=> $this->faker->boolean ? \Illuminate\Support\Carbon::now() : null,
        ];
    }
}
