<?php

use App\User;
use Illuminate\Database\Migrations\Migration;

class AddDefaultAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'name' => 'Froyonion',
            'email' => 'froyo@froyonion.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
