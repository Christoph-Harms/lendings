<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('lendings')->middleware(['auth:api'])->group(function(){
    Route::get('/', 'LendingsController@index')->name('lendings.api_index');
    Route::post('/', 'LendingsController@store')->name('lendings.store');
});

Route::prefix('items')->middleware(['auth:api'])->group(function(){
    Route::get('/', 'ItemsController@index')->name('items.api_index');
    Route::post('/', 'ItemsController@store')->name('items.create');
    Route::delete('/{id}', 'ItemsController@destroy')->name('items.destroy');
});
