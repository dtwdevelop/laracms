<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => 'sandbox95fe0c14b2dd4492b52ea0fd2366eb1b.mailgun.org',
		'secret' => 'key-5a67c262a7822dd0e4c68b8ea1a75421',
	],

	'mandrill' => [
		'secret' => 'xxWII6t3ZMvbMrOcs3NqEA',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],
    'mandrill' => [
    'secret' => 'your-mandrill-key',
],
    
    'paypal' => [
    'client_id' => env("PAY_ID"),
    'secret' => env("PAY_SECRET")
],


];
