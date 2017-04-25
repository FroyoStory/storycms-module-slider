<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisibilityAndImageNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->boolean('visibility')->default(true);
            $table->string('image_url')->nullable();
        });
    }

    public function drop()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn(['visibility', 'image_url']);
        });
    }
}
