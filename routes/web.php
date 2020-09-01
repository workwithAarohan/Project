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


Route::get('/test', function () {
    return view('layouts.test');
});
Route::get('brand/create/{cat_id}','BrandController@create')->name('brand.create');

// Route::post('signup','UserController@create')->name('create.user');
Route::get('dashboard','NavController@dashboard');

Route::resource('category','CategoryController');
Route::get('del/{cat_id}','CategoryController@destroy')->name('category.destroy'); 

Route::resource('subcategory','SubcategoryController');
Route::get('subcat/{cat_id}','SubcategoryController@index')->name('subcat.index');
Route::get('delsubcat/{subcat_id}','SubcategoryController@destroy')->name('subcat.destroy');

Route::get('brand/{subcat_id}','BrandController@index')->name('brand.index');
Route::post('brand/store','BrandController@store')->name('brand.store');
Route::get('brand/{brand_id}/edit','BrandController@edit')->name('brand.edit');
Route::put('brand/{brand_id}','BrandController@update')->name('brand.update');
Route::get('delbrand/{brand_id}','BrandController@destroy')->name('brand.destroy');

Route::get('product/{brand_id}','ProductController@index')->name('product.index');
Route::post('product/store','ProductController@store')->name('product.store');
Route::get('product/{product_id}/edit','ProductController@edit')->name('product.edit');
Route::put('product/{product_id}','ProductController@update')->name('product.update');
Route::get('delproduct/{product_id}','ProductController@destroy')->name('product.destroy');
Route::get('showproduct/{product_id}','ProductController@show')->name('product.show');

Route::post('review/store','ProductController@storereview')->name('review.store');
Route::get('product/allbrands/{subcat_id}','ProductController@allbrands');

Route::resource('description','DescriptionController');

Route::get('counter/{user_id}','CounterController@index')->name('counter.index');
Route::post('addcart','CounterController@addcart')->name('cart.create')->middleware('auth');
Route::put('updatecart/{cart_id}','CounterController@updatecart')->name('cart.update');
Route::get('delcart/{cart_id}','CounterController@delcart')->name('cart.destroy');
Route::post('order','CounterController@order')->name('counter.order');



Route::get('search','NavController@search');



Auth::routes();

Route::get('/admin_dashboard', 'HomeController@index')->name('home');
