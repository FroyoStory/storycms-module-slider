<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('slug')->unique();
            $table->timestamps();

            NestedSet::columns($table);
        });

        Schema::create('trans_navigations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('navigation_id')->unsigned();
            $table->string('name');
            $table->char('locale', 2)->default('en');

            $table->foreign('navigation_id')->references('id')->on('navigations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_navigations');
        Schema::dropIfExists('navigations');
    }
}
