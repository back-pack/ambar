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

Route::get('articles/pdf', 'ArticleController@pdf')->name('articles.pdf');
Route::post('orders/destroy-several', 'OrderController@destroySeveral')->name('orders.destroy-several');
Route::get('orders/deletes', 'OrderController@deletes')->name('orders.deletes');

Route::resource('clients', 'ClientController');
Route::resource('orders', 'OrderController');
Route::resource('payments', 'PaymentController');
Route::resource('categories', 'CategoryController');
Route::resource('articles', 'ArticleController');
Route::resource('users', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');
