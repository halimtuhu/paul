<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('content');
            $table->integer('news_category_id');
            $table->unsignedInteger('liked')->default(0);
            $table->unsignedInteger('shared')->default(0);
            $table->timestamps();
        });

        Schema::create('news_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('news_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('news_id');
            $table->text('comment');
            $table->timestamps();
        });

        Schema::create('news_like', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('news_id');
            $table->timestamps();
        });

        Schema::create('news_share', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('news_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_category');
        Schema::dropIfExists('news_comment');
        Schema::dropIfExists('news_like');
        Schema::dropIfExists('news_share');
    }
}