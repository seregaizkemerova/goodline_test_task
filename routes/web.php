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

/*
Route::get('/', function () {
});
*/

Route::get('/', 'PastaController@index');

Route::post('/add', 'PastaController@addText');

Route::get('/pasta{link}', 'PastaController@getText');

Route::get('/search', 'PastaController@search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('soclogin', 'Auth\SocialAuthController@socLogin');
