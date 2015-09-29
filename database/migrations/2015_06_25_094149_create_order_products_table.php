<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('order_products', function(Blueprint $table) {
            $table->increments('id');
             $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            
            $table->foreign('order_id')
                    ->references('id')->on('orders')
                    ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                    ->onDelete('set null');
            
            $table->char('product_name', 200);
             $table->decimal('product_price', 8, 2);
             $table->integer('quantity')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('order_products');
    }

}
