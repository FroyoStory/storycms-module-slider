<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Story\Cms\Contracts\StoryCategory;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default('0');
            $table->string('slug')->unique();
            $table->json('name');
            $table->json('description')->nullable();
            $table->timestamps();
        });

        // Resolve service container
        resolve(StoryCategory::class)::create([
            'parent_id' => 0,
            'slug' => 'uncategorized',
            'name' => [
                'en' => 'Uncategorized',
                'id' => 'Tidak bekategori'
            ],
            'description' => [
                'en' => 'Uncategorized',
                'id' => 'Tidak bekategori'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
