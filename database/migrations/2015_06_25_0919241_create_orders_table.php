<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->char('billing_country', 2);
            $table->char('billing_first_name', 32);
            $table->char('billing_last_name', 32);
            $table->char('billing_company', 32);
            $table->char('billing_address_1', 32);
            $table->char('billing_address_2', 32);
            $table->char('billing_city', 32);
            $table->char('billing_state', 32);
            $table->char('billing_postcode', 16);
            $table->char('billing_email', 64);
            $table->char('billing_phone', 16);
            $table->char('shipping_country', 2);
            $table->char('shipping_first_name', 32);
            $table->char('shipping_last_name', 32);
            $table->char('shipping_company', 32);
            $table->char('shipping_address_1', 64);
            $table->char('shipping_address_2', 64);
            $table->char('shipping_city', 32);
            $table->char('shipping_state', 32);
            $table->char('shipping_postcode', 16);
            $table->char('shipping_email', 64);
            $table->char('shipping_phone', 16);
            $table->tinyInteger('ship_to_billing');
            $table->char('order_ip', 32);
            $table->char('order_hash', 60);
            $table->tinyInteger('order_status');
            $table->char('order_currency', 3);
            $table->char('order_locale', 5);
            $table->decimal('order_total_sum', 8, 2);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('set null');
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('orders');
    }

}
