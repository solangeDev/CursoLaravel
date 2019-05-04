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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/contacts/update/{id}', 'ContactController@show')->name('update');

    Route::put('/contacts/update/{id}', 'ContactController@update')->name('updateform');
    
    Route::get('/contacts/create', 'ContactController@create')->name('create');
    Route::post('/contacts/create', 'ContactController@store')->name('store');
});



//Route::resource('contacts','ContactController');
