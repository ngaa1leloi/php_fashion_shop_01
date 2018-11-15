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

Route::get('logout', ['as' => 'logout', 'uses'=>'UserController@logout']);

Route::get('admin/login', 'UserController@getLoginAdmin')->name('getlogin');
Route::get('admin/logout', 'UserController@getLogout')->name('getlogout');
Route::post('admin/login', 'UserController@postLoginAdmin')->name('postlogin');
Route::get('home', 'PageController@getHome')->name('home');
Route::get('product/{id}', 'PageController@getProduct')->name('product');
Route::get('product/{product_id}/{color_id}', 'PageController@getProduct_withColor')->name('product_with_color');
Route::post('product/{id}','PageController@comment');
Route::get('product_type/{id}', 'PageController@getProductType')->name('product_type');
Route::get('search', 'PageController@search')->name('search');

Route::middleware('adminLogin')->prefix('admin')->group(function() {
    Route::prefix('category')->group(function() {
        Route::get('list', 'CategoryController@getList')->name('list_category');

        Route::get('add', 'CategoryController@getAdd')->name('add_category');
        Route::post('add', 'CategoryController@postAdd')->name('add_category');

        Route::get('edit/{id}', 'CategoryController@getEdit')->name('edit_category');
        Route::post('edit/{id}', 'CategoryController@postEdit')->name('edit_category');

        Route::get('delete/{id}', 'CategoryController@getDelete')->name('delete_category');
    });

    Route::prefix('slide')->group(function() {
        Route::get('list', 'SlideController@getList')->name('list_slide');

        Route::get('add', 'SlideController@getAdd')->name('add_slide');
        Route::post('add', 'SlideController@postAdd')->name('add_slide');

        Route::get('edit/{id}', 'SlideController@getEdit')->name('edit_slide');
        Route::post('edit/{id}', 'SlideController@postEdit')->name('edit_slide');

        Route::get('delete/{id}', 'SlideController@getDelete')->name('delete_slide');
    });

    Route::prefix('manufacturer')->group(function() {
        Route::get('list', 'ManufacturerController@getList')->name('list_manufacturer');

        Route::get('add', 'ManufacturerController@getAdd')->name('add_manufacturer');
        Route::post('add', 'ManufacturerController@postAdd')->name('add_manufacturer');

        Route::get('edit/{id}', 'ManufacturerController@getEdit')->name('edit_manufacturer');
        Route::post('edit/{id}', 'ManufacturerController@postEdit')->name('edit_manufacturer');

        Route::get('delete/{id}', 'ManufacturerController@getDelete')->name('delete_manufacturer');
    });

    Route::prefix('product')->group(function() {
        Route::get('list', 'ProductController@getList')->name('list_product');

        Route::get('add', 'ProductController@getAdd')->name('add_product');
        Route::post('add', 'ProductController@postAdd')->name('add_product');

        Route::get('edit/{id}', 'ProductController@getEdit')->name('edit_product');
        Route::post('edit/{id}', 'ProductController@postEdit')->name('edit_product');

        Route::get('delete/{id}', 'ProductController@getDelete')->name('delete_product');
    });

    Route::prefix('promotion')->group(function() {
        Route::get('list', 'PromotionController@getList')->name('list_promotion');

        Route::get('add', 'PromotionController@getAdd')->name('add_promotion');
        Route::post('add', 'PromotionController@postAdd')->name('add_promotion');

        Route::get('edit/{id}', 'PromotionController@getEdit')->name('edit_promotion');
        Route::post('edit/{id}', 'PromotionController@postEdit')->name('edit_promotion');

        Route::get('delete/{id}', 'PromotionController@getDelete')->name('delete_promotion');
    });

    Route::prefix('shop')->group(function() {
        Route::get('list', 'ShopController@getList')->name('list_shop');

        Route::get('add', 'ShopController@getAdd')->name('add_shop');
        Route::post('add', 'ShopController@postAdd')->name('add_shop');

        Route::get('edit/{id}', 'ShopController@getEdit')->name('edit_shop');
        Route::post('edit/{id}', 'ShopController@postEdit')->name('edit_shop');

        Route::get('delete/{id}', 'ShopController@getDelete')->name('delete_shop');
    });

    Route::prefix('bill')->group(function() {
        Route::get('list', 'BillController@getList')->name('list_bill');

        Route::get('detail/{id}', 'BillController@getDetailBill')->name('detail_bill');
        Route::post('detail/{id}', 'BillController@postDetailBill')->name('detail_bill');

        Route::get('delete/{id}', 'BillController@getDelete')->name('delete_bill');
    });

    Route::prefix('ajax')->group(function() {
        Route::get('category/{id}', 'AjaxController@getCategory');
        Route::get('manufacturer', 'AjaxController@getManufacturer');
    });

});
Route::get('cart', 'PageController@getCart')->name('cart');
Route::get('add_cart/{id}', 'PageController@addCart')->name('add_cart');
Route::get('add_cart/{product_id}/{color_id}/{size_id}', 'PageController@addCartDetail')->name('add_cart_detail');
Route::get('remove_cart/{id}', 'PageController@removeCart');
Route::get('destroy_cart', 'PageController@destroyCart');
Route::get('down_item/{id}','PageController@minusQtyCart')->name('down_item');
Route::get('up_item/{id}', 'PageController@addQtyCart')->name('up_item');
Route::get('checkout', 'PageController@getCheckout');
Route::post('checkout', 'PageController@postCheckout');
Route::get('order_history', 'PageController@getOrderHistory')->name('order_history');
Route::get('order_detail/{id}', 'PageController@getOrderDetail')->name('order_detail');
Route::get('bill_update/{id}', 'PageController@getBillUpdate')->name('bill_update');

Auth::routes();
