<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('likeables', function (Blueprint $table) {
            $table->morphs('likeable');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('like_id')->constrained('likes', 'id');
            
            $table->primary(['likeable_id','likeable_type', 'user_id']);
        });

        Schema::create('commentables', function (Blueprint $table) {
            $table->id();
            $table->morphs('commentable');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('body');
            $table->timestamps();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('name');
            $table->string('surname');
            $table->string('position')->nullable();
            $table->string('description')->nullable();
            $table->string('nickname')->unique()->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('authors', 'id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('image_url');
            $table->string('description')->nullable();
            $table->string('body');
            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->boolean('is_published')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
        
        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained('tags', 'id');
            $table->foreignId('article_id')->unique()->constrained('articles', 'id');
        });

        Schema::create('article_counts', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles', 'id');
            $table->integer('comment_count')->default(0);
            $table->integer('like_count')->default(0);

            $table->primary('article_id');
        });

        Schema::create('comment_counts', function (Blueprint $table) {
            $table->foreignId('comment_id')->constrained('commentables', 'id');
            $table->integer('like_count')->default(0);

            $table->primary('comment_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_counts');
        Schema::dropIfExists('article_counts');
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('commentables');
        Schema::dropIfExists('likeables');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('tags');
    }
}
