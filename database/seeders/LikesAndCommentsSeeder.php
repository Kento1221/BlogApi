<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\LikeType;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesAndCommentsSeeder extends Seeder
{

    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp =  now()->toDateTimeString();
        $likes = [];
        $comments = [];
        $likeables = Article::all(['id']);

        foreach ($likeables as $item) {
            $likes[] = [
                'likeable_type' => 'article',
                'likeable_id' => $item['id'],
                'user_id' => User::inRandomOrder()->first()->id,
                'like_id' => LikeType::inRandomOrder()->first()->id,
            ];
            $comments[] = [
                'commentable_type' => 'article',
                'commentable_id' => $item['id'],
                'user_id' => User::inRandomOrder()->first()->id,
                'body' => $this->faker->sentence,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }
        Like::insert($likes);
        Comment::insert($comments);

        $likes = [];
        $comments = [];
        $likeables = Comment::all(['id']);

        foreach ($likeables as $item) {
            $likes[] = [
                'likeable_type' => 'comment',
                'likeable_id' => $item['id'],
                'user_id' => User::inRandomOrder()->first()->id,
                'like_id' => LikeType::inRandomOrder()->first()->id,
            ];

            $comments[] = [
                'commentable_type' => 'comment',
                'commentable_id' => $item['id'],
                'user_id' => User::inRandomOrder()->first()->id,
                'body' => $this->faker->sentence,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }
            Like::insert($likes);
            Comment::insert($comments);
    }
}
