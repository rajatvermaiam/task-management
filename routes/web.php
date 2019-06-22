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

Route::get('/', 'TaskController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('task', 'TaskController');

Route::get('/assign/{id}', 'TaskController@assign');

Route::post('/assign/{id}', 'TaskController@assignStore');

Route::get('/completed-task', 'TaskController@completedTask');

Route::get('/completed/{id}', 'TaskController@completed');



