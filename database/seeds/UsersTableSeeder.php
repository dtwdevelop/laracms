<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		\App\User::create([
			'name' => 'Admin User',
			'username' => 'admin_user',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'confirmed' => 1,
                   
            'admin' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
                      'country' => str_random(2),
                     'locale' => str_random(2),
                     'currency' => str_random(3),
                     'first_name' => str_random(10),
                     'last_name' => str_random(10),
                     'company' => str_random(10),
                     'address_1' => str_random(10),
                     'address_2' => str_random(10),
                     'city' => str_random(10),
                     'state' => str_random(10),
                     'postcode' => str_random(10),
                     'phone' => "12345678",
		]);

		\App\User::create([
			'name' => 'Test User',
			'username' => 'test_user',
			'email' => 'user@user.com',
			'password' => bcrypt('user'),
			'confirmed' => 1,
                    
	             'confirmation_code' => md5(microtime() . env('APP_KEY')),
                     'country' => str_random(2),
                     'locale' => str_random(2),
                     'currency' => str_random(10),
                     'first_name' => str_random(10),
                     'last_name' => str_random(10),
                     'company' => str_random(10),
                     'address_1' => str_random(10),
                     'address_2' => str_random(10),
                     'city' => str_random(10),
                     'state' => str_random(10),
                     'postcode' => str_random(10),
                     'phone' => "12345678",
		]);

		//TestDummy::times(10)->create('App\User');

	}

}
