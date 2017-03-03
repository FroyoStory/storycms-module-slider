<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Story\Cms\Models\Role;
use Story\Cms\Models\User;

class CreateRoleTable extends Migration
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
            $table->timestamps();
        });

        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Author']);
        Role::create(['name' => 'User']);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->integer('role_id')->nullable();
            $table->boolean('blocked')->default(false);
        });

        User::where('email', 'froyo@froyonion.com')->update([
            'role_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
            $table->dropColumn('role_id');
            $table->dropColumn('blocked');
        });

        Schema::dropIfExists('roles');
    }
}
