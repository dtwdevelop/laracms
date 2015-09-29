<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Frontend'], function () {

    // Pages
    Route::get('/', 'IndexController@_getIndex');
    Route::get('/about-us', 'IndexController@_getAboutUs');
    Route::get('/my-cart', 'IndexController@_getMyCart');
    Route::get('/remove/{id}', 'IndexController@_removeItem');
    Route::get('/my-profile', ['middleware' => 'auth', 'uses' => 'IndexController@_getMyProfile']);
    Route::post('/my-profile', ['middleware' => 'auth', 'uses' => 'IndexController@_getMyProfile']);
    Route::post('/checkout', 'IndexController@_getCheckout');
    Route::get('/home', 'IndexController@_getIndex');
    Route::get('/files/{id}', 'IndexController@_download');
    Route::get('/terms', 'IndexController@_getTerms');
    Route::get('/cookies', 'IndexController@_getCookies');

    // Contact
    Route::post('/', 'IndexController@_postAjaxSendContactMessage');
    Route::get('/codegenerator', 'IndexController@_codeGenerator');

    // Auth and registration
    Route::get('/auth', 'IndexController@_getAuth');
    Route::post('/auth', 'IndexController@_postAuth');
    Route::get('/logout', 'IndexController@_getLogout');
    Route::post('/register', 'IndexController@_postRegister');
    Route::get('/activate_account/{code}', 'IndexController@_getActivateAccount');


    // Password
    Route::get('/reset-password', 'IndexController@_getResetPassword');
    Route::post('/lost', 'IndexController@_resetPassword');
    Route::get('/change-password', 'IndexController@_getChangePassword');
    Route::post('/change', 'IndexController@_postChangePassword');

    // Payment, coupon and cart
    Route::post('/pay', 'IndexController@_pay');
    Route::get('/done', 'IndexController@done');
    Route::get('/cancel', 'IndexController@cancel');
    Route::get('/addcart/{id}', 'IndexController@_addCart');
    Route::get('/thank-you-for-order', 'IndexController@_getThankYouForOrder');
    Route::get('/api/get-coupon/{id}', 'IndexController@_ajaxGetCoupon');

    // ?
    Route::get('/mail', 'IndexController@_mail');
    Route::get('/test/modal', 'IndexController@_getTestModal');

    // AJAX
    Route::get('/api/get-modal-strings', 'IndexController@_getAjaxModalStrings');

});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    # Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');
    Route::get('/', 'DashboardController@index');

    # Users
    Route::get('users/', 'UserController@index');
    Route::get('users/create', 'UserController@getCreate');
    Route::post('users/create', 'UserController@postCreate');
    Route::get('users/{id}/edit', 'UserController@getEdit');
    Route::post('users/{id}/edit', 'UserController@postEdit');
    Route::get('users/{id}/delete', 'UserController@getDelete');
    Route::post('users/{id}/delete', 'UserController@postDelete');
    Route::get('users/data', 'UserController@data');

    # Sliders
    Route::get('sliders/', 'SlidersController@index');
    Route::get('sliders/create', 'SlidersController@getCreate');
    Route::post('sliders/create', 'SlidersController@postCreate');
    Route::get('sliders/{id}/edit', 'SlidersController@getEdit');
    Route::post('sliders/{id}/edit', 'SlidersController@postEdit');
    Route::get('sliders/{id}/delete', 'SlidersController@getDelete');

    # Configurations
    Route::get('config/', 'ConfigController@index');
    Route::post('config/', 'ConfigController@postUpdate');

    // Pages
    Route::get('pages/', 'PagesController@index');
    Route::get('pages/create', 'PagesController@create');
    Route::post('pages/store', 'PagesController@store');
    Route::post('pages/update/', 'PagesController@update');
    Route::get('pages/edit/{id}', 'PagesController@edit');
    Route::delete('pages/delete/{id}', 'PagesController@destroy');
    // Contact

    Route::get('contact_messages/', 'ContactMessagesAdminController@index');
    Route::get('contact_messages/review/{id}', 'ContactMessagesAdminController@show');
    Route::get('contact_messages/view/{id}', 'ContactMessagesAdminController@view');
    Route::post('contact_messages/update', 'ContactMessagesAdminController@update');

    // Product
    Route::get('products/', 'ProductsAdminController@index');
    Route::get('products/create', 'ProductsAdminController@create');
    Route::post('products/store', 'ProductsAdminController@store');
    Route::post('products/update/', 'ProductsAdminController@update');
    Route::get('products/edit/{id}', 'ProductsAdminController@edit');
    Route::delete('products/delete/{id}', 'ProductsAdminController@destroy');

    // Setting
    Route::get('site_settings/', 'SiteSettingsAdminController@index');
    Route::post('site_settings/update/', 'SiteSettingsAdminController@update');
    Route::post('site_settings/createsocial/', 'SiteSettingsAdminController@createsocial');
    Route::post('site_settings/add/', 'SiteSettingsAdminController@addsoc');
    Route::get('site_settings/delete/{id}', 'SiteSettingsAdminController@destroy');

    // Files
    Route::get('files/', 'FilesAdminController@index');
    Route::get('files/create', 'FilesAdminController@create');
    Route::post('files/store', 'FilesAdminController@store');
    Route::post('files/update/', 'FilesAdminController@update');
    Route::get('files/edit/{id}', 'FilesAdminController@edit');
    Route::delete('files/delete/{id}', 'FilesAdminController@destroy');
    Route::get('files/download/{id}', 'FilesAdminController@download');

    // Feedbacks
    Route::get("feedbacks/", 'FeedbacksAdminController@index');
    Route::get('feedbacks/edit/{id}', 'FeedbacksAdminController@edit');
    Route::post('feedbacks/update/', 'FeedbacksAdminController@update');
    Route::delete('feedbacks/delete/{id}', 'FeedbacksAdminController@destroy');

    // FAQ
    Route::get("faqs/", 'FaqsAdminController@index');
    Route::get('faqs/edit/{id}', 'FaqsAdminController@edit');
    Route::post('faqs/update/', 'FaqsAdminController@update');
    Route::delete('faqs/delete/{id}', 'FaqsAdminController@destroy');

    // Benefits
    Route::get("benefits/", 'BenefitsAdminController@index');
    Route::get('benefits/edit/{id}', 'BenefitsAdminController@edit');
    Route::post('benefits/update/', 'BenefitsAdminController@update');
    Route::delete('benefits/delete/{id}', 'BenefitsAdminController@destroy');

    // Coupon
    Route::get("discount_coupons/", 'DiscountCouponsAdminController@index');
    Route::post('discount_coupons/store', 'DiscountCouponsAdminController@store');
    Route::get("discount_coupons/create", 'DiscountCouponsAdminController@create');
    Route::get('/discount_coupons/{id}/send', 'DiscountCouponsAdminController@_getSendEmail');
    Route::delete('discount_coupons/delete/{id}', 'DiscountCouponsAdminController@destroy');
    Route::post('discount_coupons/sendmail', 'DiscountCouponsAdminController@_sendToEmail');

    // Order
    Route::get("orders/", 'OrdersAdminController@index');
    Route::post("orders/completed", 'OrdersAdminController@completed');

    // Advertising
    Route::get("advertising/", 'AdvertisingAdminController@index');
    Route::get("advertising/create", 'AdvertisingAdminController@create');

    Route::post('advertising/', 'AdvertisingAdminController@store');
    Route::get('advertising/{id}/edit', 'AdvertisingAdminController@edit');
    Route::post('advertising/update/', 'AdvertisingAdminController@update');
    Route::delete('advertising/delete/{id}', 'AdvertisingAdminController@destroy');
    Route::get("advertising/active/{id}", 'AdvertisingAdminController@_active');

});
