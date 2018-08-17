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
Route::post('login', 'API\UserController@login');
Route::post('create_booking', 'API\UserController@create_booking');
Route::post('edit_booking', 'API\UserController@edit_booking');
Route::get('read_booking', 'API\UserController@read_booking');
Route::get('delete_booking', 'API\UserController@delete_booking');
Route::post('create_group', 'API\UserController@create_group');
Route::post('edit_group', 'API\UserController@edit_group');
Route::get('read_group', 'API\UserController@read_group');
Route::get('delete_group', 'API\UserController@delete_group');