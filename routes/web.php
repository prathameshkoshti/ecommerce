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

	//Routes for brands management
	Route::group(['prefix' => 'brands'], function(){
		Route::get('/', 'BrandsController@index');

		Route::get('create', 'BrandsController@create');
		Route::put('store', 'BrandsController@store');

		Route::get('view/{id}', 'BrandsController@show');

		Route::get('edit/{id}', 'BrandsController@edit');
		Route::put('update/{id}', 'BrandsController@update');

		Route::get('delete/{id}', 'BrandsController@destroy');
	});

	//Routes for Profile Management
    Route::get('profile', 'ProfilesController@show');
    Route::put('profile/update', 'ProfilesController@updateProfile');

    Route::get('change_password', 'ProfilesController@changePassword');
    Route::put('update_password', 'ProfilesController@updatePassword');
});

Route::view('home', 'users.home');