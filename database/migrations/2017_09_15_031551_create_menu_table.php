<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Story\Cms\Contracts\StoryMenu;
use Kalnoy\Nestedset\NestedSet;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->json('name');
            $table->text('url')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('user_id');
            $table->boolean('active');
            $table->timestamps();

            NestedSet::columns($table);
        });

         // Resolve service container
        resolve(StoryMenu::class)::create([
            'name' => [
                'en' => 'Root',
                'id' => 'Root'
            ],
            'url' => '',
            'user_id' => 1,
            'active' => 0
        ]);

        resolve(StoryMenu::class)::create([
            'name' => [
                'en' => 'Home',
                'id' => 'Beranda'
            ],
            'url' => '/',
            'user_id' => 1,
            'parent_id' => 1,
            'active' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
