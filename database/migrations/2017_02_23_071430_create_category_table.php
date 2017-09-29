<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Story\Cms\Contracts\StoryCategory;
use Kalnoy\Nestedset\NestedSet;


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
            $table->string('slug')->unique();
            $table->json('name');
            $table->json('description')->nullable();
            $table->timestamps();

            NestedSet::columns($table);
        });

        // Resolve service container
        resolve(StoryCategory::class)::create([
            'slug' => 'root',
            'name' => [
                'en' => 'Root',
                'id' => 'Root'
            ],
            'description' => [
                'en' => '',
                'id' => ''
            ]
        ]);

        // Resolve service container
        resolve(StoryCategory::class)::create([
            'slug' => 'uncategorized',
            'name' => [
                'en' => 'Uncategorized',
                'id' => 'Tidak bekategori'
            ],
            'description' => [
                'en' => 'Uncategorized',
                'id' => 'Tidak bekategori'
            ],
            'parent_id' => 1
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
