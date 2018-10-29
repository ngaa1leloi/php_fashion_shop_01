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
Route::get('/', function()
{
    return view('welcome');
});

Route::get('admin/login', 'UserController@getLoginAdmin')->name('getlogin');
Route::post('admin/login', 'UserController@postLoginAdmin')->name('postlogin');

Route::prefix('admin')->group(function () {
    Route::prefix('category')->group(function () {
    	Route::get('list', 'CategoryController@getList');
    	Route::get('add', 'CategoryController@getAdd');
        Route::post('add', 'CategoryController@postAdd');
    });

    Route::prefix('slide')->group(function () {
        Route::get('list', 'SlideController@getList')->name('list_slide');

        Route::get('add', 'SlideController@getAdd')->name('add_slide');
        Route::post('add', 'SlideController@postAdd')->name('add_slide');

        Route::get('edit/{id}', 'SlideController@getEdit')->name('edit_slide');
        Route::post('edit/{id}', 'SlideController@postEdit')->name('edit_slide');

        Route::get('delete/{id}', 'SlideController@getDelete')->name('delete_slide');
    });

    Route::group(['prefix' => 'manufacturer'], function()
    {
        Route::get('list', 'ManufacturerController@getList')->name('list_manufacturer');

        Route::get('add', 'ManufacturerController@getAdd')->name('add_manufacturer');
        Route::post('add', 'ManufacturerController@postAdd')->name('add_manufacturer');

        Route::get('edit/{id}', 'ManufacturerController@getEdit')->name('edit_manufacturer');
        Route::post('edit/{id}', 'ManufacturerController@postEdit')->name('edit_manufacturer');

        Route::get('delete/{id}', 'ManufacturerController@getDelete')->name('delete_manufacturer');
    });

    Route::group(['prefix' => 'promotion'], function()
    {
        Route::get('list', 'PromotionController@getList')->name('list_promotion');

        Route::get('add', 'PromotionController@getAdd')->name('add_promotion');
        Route::post('add', 'PromotionController@postAdd')->name('add_promotion');

        Route::get('edit/{id}', 'PromotionController@getEdit')->name('edit_promotion');
        Route::post('edit/{id}', 'PromotionController@postEdit')->name('edit_promotion');

        Route::get('delete/{id}', 'PromotionController@getDelete')->name('delete_promotion');
    });

    Route::group(['prefix' => 'shop'], function()
    {
        Route::get('list', 'ShopController@getList')->name('list_shop');

        Route::get('add', 'ShopController@getAdd')->name('add_shop');
        Route::post('add', 'ShopController@postAdd')->name('add_shop');

        Route::get('edit/{id}', 'ShopController@getEdit')->name('edit_shop');
        Route::post('edit/{id}', 'ShopController@postEdit')->name('edit_shop');

        Route::get('delete/{id}', 'ShopController@getDelete')->name('delete_shop');
    });
});
