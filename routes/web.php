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

Route::get('/', 'FrontController@getIndex');
Route::get('/newagentsignup', 'FrontController@getNewAgentSignup');
Route::get('/requesttraining', 'FrontController@getRequestTraining');
Route::get('/howwework', 'FrontController@getHowWeWork');
Route::get('/marketingcollateral', 'FrontController@getMarketingCollateral');
Route::get('/newsletterarchive', 'FrontController@getNewsletterArchive');
Route::get('/webinarsandevents', 'FrontController@getWebinarsAndEvents');
Route::get('/groups', 'FrontController@getGroups');
Route::get('/travelagentfaq', 'FrontController@getTravelAgentFAQ');
Route::get('/mediacenter', 'FrontController@getMediaCenter');
Route::get('/bookingbooster', 'FrontController@getBookingBooster');
Route::get('/customerreviews', 'FrontController@getCustomerReviews');
Route::get('/feed', 'FrontController@getFeed');
Route::get('/comments/feed', 'FrontController@getCommentsFeed');

Route::get('/dashboard/home', ['as' => 'dashboard_home', 'uses' => 'AdminController@getIndex'])->middleware('authSentinel');
Route::get('/dashboard/importer', ['as' => 'contact_importer', 'uses' => 'AdminController@getContactImporter'])->middleware('authSentinel');
Route::get('/dashboard/login', ['as' => 'dashboard_login', 'uses' => 'AdminController@getLogin']);

Route::get('/data/importer', 'ContactImporterController@getData');


Route::post('/dashboard/login/doLogin', 'AuthController@doLogin');
Route::get('/dashboard/login/logout', 'AuthController@logout');

