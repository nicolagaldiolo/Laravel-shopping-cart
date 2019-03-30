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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();


Route::get('/', function () {
    return view('index');
});


Route::resource('categories', 'CategoriesController')->only('index');
Route::get('categories/{category}/books', 'BooksController@index')->name('books');
Route::get('categories/{category}/book/{book}', 'BooksController@show')->name('book');

Route::resource('cart', 'CartController')->except(['create', 'show', 'edit']);

Route::group(
    [
        'middleware' => ['auth', 'verified']
    ], function() {

    Route::get('cart/checkout', 'CartController@checkout')->name('cart.checkout');
    Route::resource('orders', 'OrderController')->only(['index', 'store', 'show']);
});