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


Route::prefix('students')->group(function(){

	Route::resource('welcome','Students\WelcomeController')->only('index','store');
	Route::resource('auth','Students\AuthController')->only('index','store')->middleware('sessionActive');
	Route::resource('publish','Students\PublishController')->only('index','show')->middleware('codeAuth');


});