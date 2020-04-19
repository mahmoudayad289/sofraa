<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['prefix' => 'admin', 'middleware' => ['auth'] ], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('cities','CityController');
    Route::resource('districts','DistrictController');
    Route::resource('clients','ClientController');
    Route::resource('contacts','ContactController');
    Route::resource('categories','CategoryController');
    Route::resource('restaurants','RestaurantController');
    Route::resource('settings','SettingsController');
    Route::resource('products','ProductController');
    Route::resource('offers','OfferController');
    Route::resource('orders','OrderController');
    Route::resource('users','UserController');
    Route::get('logout','UserController@logout')->name('user.logout');


});


Route::group(['namespace' => 'Front\Client' ], function () {

    Route::get('/','MainController@index')->name('front.home');

    Route::get('register-client','AuthController@showRegisterClient')->name('show.register.client');
    Route::post('register-client','AuthController@doRegisterClient')->name('do.register.client');
    Route::get('login-client','AuthController@showLoginClient')->name('show.login.client');
    Route::post('login-client','AuthController@doLoginClient')->name('do.login.client');
    Route::get('logout-client','AuthController@logoutClient')->name('logout.client');


    // routes to reset password client

    Route::get('show-password','AuthController@ShowResetPasswordClient')->name('show.reset.password.client');
    Route::get('reset-new-password','AuthController@ShowNewPasswordClient')->name('show.new.password.client');

    Route::post('reset-password','AuthController@resetPassword')->name('reset.password.client');
    Route::post('new-password','AuthController@newPassword')->name('new.password.client');


    Route::get('contact','MainController@contact')->name('contact');
    Route::post('contact-us','MainController@contactUs')->name('contact.us');
    Route::get('cart','MainController@cart')->name('cart');
    Route::get('add-to-cart/{id}','MainController@addToCart')->name('add.to.cart');



});



Route::group(['namespace' => 'Front\Restaurant' ], function () {

    Route::get('register-restaurant','AuthController@showRegisterRestaurant')->name('show.register.restaurant');
    Route::post('register-restaurant','AuthController@doRegisterRestaurant')->name('do.register.restaurant');
    Route::get('login-restaurant','AuthController@showLoginRestaurant')->name('show.login.restaurant');
    Route::post('login-restaurant','AuthController@doLoginRestaurant')->name('do.login.restaurant');
    Route::get('show-restaurant/{id}','MainController@showRestaurant')->name('show.restaurant');
    Route::get('logout-restaurant','AuthController@logoutRestaurant')->name('logout.restaurant');

    // routes to reset password client

    Route::get('show-password-restaurant','AuthController@ShowResetPasswordRestaurant')->name('show.password.restaurant');
    Route::get('reset-new-password-restaurant','AuthController@ShowNewPasswordRestaurant')->name('show.new.password.restaurant');

    Route::post('reset-password-restaurant','AuthController@resetPassword')->name('reset.password.restaurant');
    Route::post('new-password-restaurant','AuthController@newPassword')->name('new.password.restaurant');

    Route::get('restaurants','MainController@restaurants')->name('restaurants');

    Route::get('show-product/{id}','MainController@ShowProduct')->name('show.product');

    Route::group(['middleware' => ['auth:front_client'] ], function () {

        // products

        Route::get('product-form','MainController@productForm')->name('product.form');
        Route::post('create-product','MainController@createProduct')->name('create.product');
        Route::get('edit-product/{id}','MainController@EditProduct')->name('edit.product');
        Route::post('update-product/{id}','MainController@updateProduct')->name('update.product');
        Route::get('all-product','MainController@allProduct')->name('all.product');


        // offers
        Route::get('offer-form','MainController@offerForm')->name('offer.form');
        Route::get('edit-offer/{id}','MainController@EditOffer')->name('edit.offer');
        Route::get('all-offers','MainController@allOffers')->name('all.offers');
        Route::post('update-offer/{id}','MainController@updateOffer')->name('update.offer');

        Route::post('create-offer','MainController@createOffer')->name('create.offer');

    });

});

