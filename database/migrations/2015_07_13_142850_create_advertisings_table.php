<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('advertisings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('image');
            $table->string('text');
            $table->tinyInteger('is_active');
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
        Schema::drop('advertisings');
    }
}
