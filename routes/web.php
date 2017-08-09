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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('lendings')->middleware(['auth'])->group(function(){
    Route::get('/', 'LendingsController@index')->name('lendings.index');
    Route::post('/', 'LendingsController@store')->name('lendings.store');
});

Route::prefix('items')->middleware(['auth'])->group(function(){
    Route::get('/', 'ItemsController@index')->name('items.index');
    Route::delete('/{id}', 'ItemsController@destroy')->name('items.destroy');
});


