<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Story\Framework\Contracts\StoryRole;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        resolve(StoryRole::class)->create(['name' => 'Administrator']);
        resolve(StoryRole::class)->create(['name' => 'Editor']);
        resolve(StoryRole::class)->create(['name' => 'Author']);
        resolve(StoryRole::class)->create(['name' => 'Guest']);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
