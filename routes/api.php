<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// route for client area

Route::group(['prefix' => 'v1'], function () {


    Route::group(['prefix' => 'client', 'namespace' => 'Api\Client'], function () {


        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');
        Route::get('districts', 'MainController@districts');
        Route::get('cities', 'MainController@cities');
        Route::get('settings', 'MainController@settings');


        Route::group(['middleware' => 'auth:clients'], function () {

            Route::post('contacts', 'MainController@contacts');
            Route::get('profile', 'AuthController@profile');
            Route::post('edit-profile', 'AuthController@editProfile');
            Route::post('register-token', 'AuthController@registerToken');
            Route::post('remove-token', 'AuthController@removeToken');
            Route::post('reviews', 'MainController@addReviews');
            Route::get('restaurants-data', 'MainController@restaurantsData');

            // order services

            Route::post('new-order', 'MainController@newOrder');
            Route::get('current-order', 'MainController@currentOrder');
            Route::get('detail-order', 'MainController@detailsOrder');
            Route::post('accepted-order', 'MainController@acceptedOrder');
            Route::post('delivered-order', 'MainController@deliveredOrder');
            Route::post('rejected-order', 'MainController@rejectedOrder');
            Route::get('previous-order', 'MainController@previousOrder');


        });

    });





// route for restaurant area


    Route::group(['prefix' => 'restaurant', 'namespace' => 'Api\Restaurant'], function () {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');
        Route::get('districts', 'MainController@districts');
        Route::get('cities', 'MainController@cities');
        Route::get('settings', 'MainController@settings');
        Route::get('categories', 'MainController@showCategories');





        Route::group(['middleware' => 'auth:restaurants'], function () {

            Route::post('contacts', 'MainController@contacts');
            Route::get('profile', 'AuthController@profile');
            Route::post('edit-profile', 'AuthController@editProfile');

            Route::post('register-token', 'AuthController@registerToken');
            Route::post('remove-token', 'AuthController@removeToken');

            Route::get('products', 'MainController@products');
            Route::post('create-product', 'MainController@CreateProduct');
            Route::get('show-product', 'MainController@showProduct');
            Route::post('edit-product', 'MainController@editProduct');
            Route::post('delete-product', 'MainController@deleteProduct');


            Route::get('offers', 'MainController@offers');
            Route::post('create-offer', 'MainController@CreateOffer');
            Route::get('show-offer', 'MainController@showOffer');
            Route::post('edit-offer', 'MainController@editOffer');
            Route::post('delete-offer', 'MainController@deleteOffer');

            Route::get('restaurant-reviews', 'MainController@reviews');
            Route::get('restaurant-state', 'MainController@restaurantState');
            Route::post('restaurant-change-state', 'MainController@changeRestaurantState');

            Route::get('restaurant-new-order', 'MainController@restaurantNewOrder');
            Route::post('restaurant-accept-order', 'MainController@restaurantAcceptOrder');
            Route::get('restaurant-current-order', 'MainController@restaurantCurrentOrder');
            Route::get('restaurant-previous-order', 'MainController@restaurantPreviousOrder');
            Route::get('restaurant-rejected-order', 'MainController@restaurantRejectedOrder');
            Route::get('restaurant-delivered-order', 'MainController@restaurantDeliveredOrder');
            Route::post('restaurant-declined-order', 'MainController@restaurantDeclinedOrder');

            Route::get('commission', 'MainController@commission');


        });




    });



});


