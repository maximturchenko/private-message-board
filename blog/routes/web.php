<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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


Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/', 'MainController@index')->name('home');


Route::get('message/{message}/edit', 'MainController@edit');

Route::get('message/{message}/delete', 'MainController@delete');



Route::group(['prefix' => 'message'],function () {
    Route::post('/add', 'MainController@store')
        ->name('add_message')
        ->middleware('can:add-message');

    Route::put('/{message}', 'MainController@update')
        ->name('update_message')
        ->middleware('can:update-message,message');

    Route::delete('/{message}', 'MainController@destroy')
        ->name('delete_message')
        ->middleware('can:delete-message,message');
});

Route::post('/checkpassword/{message}', 'MainController@showprivatemessage');

Route::view('reg_success', 'auth.reg_success')->name('reg_success');

