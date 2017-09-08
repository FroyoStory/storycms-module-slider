<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('parent_id')->nullable();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('post_status')->default('draft');
            $table->string('comment_status')->default('closed');
            $table->string('type')->default('post');
            $table->string('mime_type')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
