<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/customers', )->name('dashboard');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/profile', 'UserController@profile')->name('profile');

    Route::get('/', 'CustomerController@list')->name('home');
    Route::get('/customers', 'CustomerController@list')->name('customers');
    Route::get('/create-customer', 'CustomerController@create')->name('create-customer');
    Route::get('/delete-customer/{id}', 'CustomerController@delete')->name('delete-customer');
    Route::get('/edit-customer/{id}', 'CustomerController@edit')->name('edit-customer');
    Route::post('/store-customer', 'CustomerController@store')->name('store-customer');

    Route::get('/numbers/{customer_id?}', 'NumberController@list')->name('numbers');
    Route::get('/create-number/{customer_id?}', 'NumberController@create')->name('create-number');
    Route::get('/delete-number/{id}', 'NumberController@delete')->name('delete-number');
    Route::get('/edit-number/{id}', 'NumberController@edit')->name('edit-number');
    Route::post('/store-number', 'NumberController@store')->name('store-number');

    Route::get('/number-preferences/{number_id?}', 'NumberPreferenceController@list')->name('number-preferences');
    Route::get('/create-number-preference/{number_id?}', 'NumberPreferenceController@create')->name('create-number-preference');
    Route::get('/delete-number-preference/{id}', 'NumberPreferenceController@delete')->name('delete-number-preference');
    Route::get('/edit-number-preference/{id}', 'NumberPreferenceController@edit')->name('edit-number-preference');
    Route::post('/store-number-preference', 'NumberPreferenceController@store')->name('store-number-preference');
});
