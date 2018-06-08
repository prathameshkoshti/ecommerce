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

Route::get('/', 'HomeController@index');

Auth::routes();

//Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'checkAdmin'], function(){

	Route::get('/', 'HomeController@index')->name('home');
	//Routes for User Management
	Route::group(['prefix' => 'users'], function(){

        Route::get('/', 'UsersController@index');

        Route::get('create', 'UsersController@create');
        Route::put('store', 'UsersController@store');

        Route::get('view/{id}', 'UsersController@show');

        Route::get('edit/{id}', 'UsersController@edit');
        Route::put('update/{id}', 'UsersController@update');

        Route::get('delete/{id}', 'UsersController@destroy');
	});

	//Routes for categories management
	Route::group(['prefix' => 'categories'], function(){
		Route::get('/', 'CategoriesController@index');

		Route::get('create', 'CategoriesController@create');
		Route::put('store', 'CategoriesController@store');

		Route::get('view/{id}', 'CategoriesController@show');

		Route::get('edit/{id}', 'CategoriesController@edit');
		Route::put('update/{id}', 'CategoriesController@update');

		Route::get('delete/{id}', 'CategoriesController@destroy');
	});

	//Routes for materials management
	Route::group(['prefix' => 'materials'], function(){
		Route::get('/', 'MaterialsController@index');

		Route::get('create', 'MaterialsController@create');
		Route::put('store', 'MaterialsController@store');

		Route::get('view/{id}', 'MaterialsController@show');

		Route::get('edit/{id}', 'MaterialsController@edit');
		Route::put('update/{id}', 'MaterialsController@update');

		Route::get('delete/{id}', 'MaterialsController@destroy');
	});

	//Routes for products management
	Route::group(['prefix' => 'products'], function(){
		Route::get('/', 'ProductsController@index');

		Route::get('create', 'ProductsController@create');
		Route::put('store', 'ProductsController@store');

		Route::get('view/{id}', 'ProductsController@show');

		Route::get('edit/{id}', 'ProductsController@edit');
		Route::put('update/{id}', 'ProductsController@update');

		Route::get('delete/{id}', 'ProductsController@destroy');
	});

	//Routes for cart management
	Route::group(['prefix' => 'carts'], function(){
		Route::get('/', 'CartsController@index');

		Route::get('view/{id}', 'CartsController@show');

		Route::get('delete/{id}', 'CartsController@destroy');
	});

	//Routes for wishlist management
	Route::group(['prefix' => 'wishlists'], function(){
		Route::get('/', 'WishlistsController@index');

		Route::get('view/{id}', 'WishlistsController@show');

		Route::get('delete/{id}', 'WishlistsController@destroy');
	});

	//Routes for orders management
	Route::group(['prefix' => 'orders'], function(){
		Route::get('/', 'OrdersController@index');

		Route::get('edit/{id}', 'OrdersController@edit');
		Route::put('update/{id}', 'OrdersController@update');

		Route::get('view/{id}', 'OrdersController@show');

		Route::get('delete/{id}', 'OrdersController@destroy');
	});

	//Routes for shipping_address management
	Route::group(['prefix' => 'shippings'], function(){
		Route::get('/', 'ShippingsController@index');

		Route::get('create', 'ShippingsController@create');
		Route::put('store', 'ShippingsController@store');

		Route::get('view/{id}', 'ShippingsController@show');

		Route::get('edit/{id}', 'ShippingsController@edit');
		Route::put('update/{id}', 'ShippingsController@update');

		Route::get('delete/{id}', 'ShippingsController@destroy');
	});

	//Routes for Profile Management
    Route::get('profile', 'ProfilesController@show');
    Route::put('profile/update', 'ProfilesController@updateProfile');

    Route::get('change_password', 'ProfilesController@changePassword');
    Route::put('update_password', 'ProfilesController@updatePassword');
});

Route::get('product/{product_id}', 'UserController@getProduct');

Route::get('category/{category_id}', 'UserController@getCategory');

Route::group(['prefix' => 'my', 'middleware' => 'checkUser'], function(){

	Route::group(['prefix' => 'shipping_addresses'], function(){
		Route::get('/', 'UserController@getShippings');

		Route::get('create', 'UserController@createShippings');
		Route::put('store', 'UserController@storeShippings');

		Route::get('edit/{id}', 'UserController@editShippings');
		Route::put('update/{id}', 'UserController@updateShippings');

		Route::get('delete/{id}', 'UserController@deleteShippings');
	});

	Route::get('orders', 'UserController@getOrders');

	Route::group(['prefix' => 'cart'], function(){
		Route::get('/', 'UserController@getCart');

		Route::get('addItem/{product_id}', 'UserController@addToCart');

		Route::get('delete/{product_id}', 'UserController@deleteFromCart');
	});

	Route::group(['prefix' => 'wishlist'], function(){
		Route::get('/', 'UserController@getWishlist');

		Route::get('addItem/{product_id}', 'UserController@addToCart');

		Route::get('delete/{product_id}', 'UserController@deleteFromWishlist');
	});

	Route::group(['prefix' => 'profile'], function(){
		Route::get('/', 'UserController@getProfile');

		Route::get('edit', 'UserController@editProfile');
		Route::put('update', 'UserController@updateProfile');
	});
});