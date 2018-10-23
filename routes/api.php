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

Route::post('/login', 'APIController@login');
Route::post('/create_booking', 'APIController@create_booking');
Route::post('/edit_booking', 'APIController@edit_booking');
Route::get('/read_booking', 'APIController@read_booking');
Route::get('/delete_booking', 'APIController@delete_booking');
Route::post('/create_group', 'APIController@create_group');
Route::post('/edit_group', 'APIController@edit_group');
Route::get('/read_group', 'APIController@read_group');
Route::get('/delete_group', 'APIController@delete_group');