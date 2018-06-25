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

	//Routes for shoe sizes management
	Route::group(['prefix' => 'sizes'], function(){
		Route::get('/', 'SizesController@index');

		Route::get('create', 'SizesController@create');
		Route::put('store', 'SizesController@store');

		Route::get('view/{id}', 'SizesController@show');

		Route::get('edit/{id}', 'SizesController@edit');
		Route::put('update/{id}', 'SizesController@update');

		Route::get('delete/{id}', 'SizesController@destroy');
	});

	//Routes for shoe quantity management
	Route::group(['prefix' => 'quantities'], function(){
		Route::get('/', 'QuantitiesController@index');

		Route::get('create', 'QuantitiesController@create');
		Route::put('store', 'QuantitiesController@store');

		Route::get('view/{id}', 'QuantitiesController@show');

		Route::get('edit/{id}', 'QuantitiesController@edit');
		Route::put('update/{id}', 'QuantitiesController@update');

		Route::get('delete/{id}', 'QuantitiesController@destroy');
	});

	//Routes for product ratings management
	Route::group(['prefix' => 'ratings'], function(){
		Route::get('/', 'RatingsController@index');

		Route::get('view/{id}', 'RatingsController@show');

		Route::get('delete/{id}', 'RatingsController@destroy');
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

Route::get('product/view/{product_id}', 'UserController@getProduct');

Route::get('category/{category_id}', 'UserController@getProductsByCategory');

Route::get('search/{search_query}', 'UserController@getProductsBySearch');

Route::get('accessories', 'UserController@getAccessories');

Route::group(['prefix' => 'my', 'middleware' => 'checkUser'], function(){

	Route::group(['prefix' => 'shipping_addresses'], function(){
		Route::get('/', 'UserController@getShippings');

		Route::get('create', 'UserController@createShippings');
		Route::put('store', 'UserController@storeShippings');

		Route::get('edit/{id}', 'UserController@editShippings');
		Route::put('update/{id}', 'UserController@updateShippings');

		Route::get('delete/{id}', 'UserController@deleteShippings');
	});

	Route::group(['prefix' => 'orders'], function(){
		Route::get('/', 'UserController@getOrders');

		Route::get('view/{order_id}', 'UserController@viewOrder');
	});

	Route::group(['prefix' => 'cart'], function(){
		Route::get('/', 'UserController@getCart');

		Route::put('update_quantity/{id}', 'UserController@updateCartQuantity');

		Route::put('add_item/{product_id}', 'UserController@addToCart');

		Route::get('remove_item/{quantity_id}', 'UserController@removeFromCart');

		Route::get('move_to_wishlist/{cart_id}', 'UserController@moveToWishlist');
	});

	Route::group(['prefix' => 'wishlist'], function(){
		Route::get('/', 'UserController@getWishlist');

		Route::put('add_item/{product_id}', 'UserController@addToWishlist');

		Route::get('remove_item/{product_id}', 'UserController@removeFromWishlist');
	});

	Route::get('/account_dashboard', 'UserController@getDashboard');

	Route::group(['prefix' => 'account_information'], function(){
		Route::get('/', 'UserController@getAccountInformation');

		Route::put('update', 'UserController@updateAccountInformation');
	});

	Route::group(['prefix' => 'address_book'], function() {
		Route::get('/', 'UserController@getShippings');

		Route::get('create', 'UserController@createShipping');
		Route::put('store', 'UserController@storeShipping');

		Route::get('edit/{id}', 'UserController@editShipping');
		Route::put('update/{id}', 'UserController@update`Shipping');

		Route::get('delete/{id}', 'UserController@deleteShipping');
	});

	Route::group(['prefix' => 'reviews'], function() {
		Route::get('/', 'UserController@getReviews');

		Route::get('create', 'UserController@createReview');
		Route::get('store', 'UserController@storeReview');

		Route::get('edit/{id}', 'UserController@editReview');
		Route::get('update/{id}', 'UserController@updateReview');

		Route::get('delete', 'UserController@deleteReview');
	});
});

Route::group(['prefix' => 'checkout', 'middleware' => 'checkUser'], function(){
	Route::get('/', 'UserController@checkout');

	Route::put('place_order', 'UserController@placeOrder');

	Route::get('order_placed', 'UserController@orderPlaced');
});