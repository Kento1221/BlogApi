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
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('like_id')->constrained('likes', 'id')->cascadeOnUpdate();

            $table->primary(['likeable_id','likeable_type', 'user_id']);
        });

        Schema::create('commentables', function (Blueprint $table) {
            $table->id();
            $table->morphs('commentable');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('body');
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('image_url');
            $table->string('description')->nullable();
            $table->string('body');
            $table->foreignId('category_id')->nullable()->constrained('categories', 'id')->nullOnDelete();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('tags', 'id')->cascadeOnDelete();
            $table->foreignId('article_id')->constrained('articles', 'id')->cascadeOnDelete();

            $table->unique(['tag_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('commentables');
        Schema::dropIfExists('likeables');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('tags');
    }
}
