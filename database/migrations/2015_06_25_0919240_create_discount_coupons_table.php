<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('discount_coupons', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();;
            $table->string('code')->unique();
            $table->string('sum');
            $table->date('valid_till');
            $table->boolean('is_activated');
            $table->boolean('is_sent');
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
        Schema::drop('discount_coupons');
    }
}
