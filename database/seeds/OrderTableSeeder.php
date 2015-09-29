<?php

use Illuminate\Database\Seeder;

use App\Order;

class OrderTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Order::unguard();
        Order::create([
            'billing_country' => str_random(2),
            'billing_first_name' => 'sample',
            'billing_last_name' => str_random(10),
            'billing_company' => str_random(10),
            'billing_address_1' => str_random(10),
            'billing_address_2' => str_random(10),
            'billing_city' => str_random(10),
            'billing_state' => str_random(10),
            'billing_postcode' => str_random(10),
            'billing_email' => str_random(2) . '@gmail.com',
            'billing_phone'=>'12345678',
            'shipping_country' => str_random(2),
            'shipping_first_name' => str_random(10),
            'shipping_last_name' => str_random(10),
            'shipping_company' => str_random(10),
            'shipping_address_1' => str_random(10),
            'shipping_address_2' => str_random(10),
            'shipping_city' => str_random(10),
            'shipping_state' => str_random(10),
            'shipping_postcode' => str_random(10),
            'shipping_email' => str_random(10),
            'shipping_phone' => str_random(10),
            'ship_to_billing' => 1,
            'order_ip' => str_random(10),
            'order_hash' => str_random(10),
            'order_status' => 1,
            'order_currency' => str_random(3),
            'order_locale' => str_random(5),
            'order_total_sum' => 2.30,
            'user_id' => 1,
            'user_id' => 1,
        ]);
    }

}
