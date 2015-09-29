<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
         
             if (!Schema::hasColumn('orders', 'discount_coupon_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->integer('discount_coupon_id')->unsigned()->nullable();
                $table->foreign('discount_coupon_id')->references('id')->on('discount_coupons')->onDelete('set null');
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

         
       

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_discount_coupon_id_foreign');
            $table->dropColumn('discount_coupon_id');
        });

    }
}
