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
Route::get('/dashboard/bookings', ['as' => 'bookings', 'uses' => 'BookingsController@getAdminTable'])->middleware('authSentinel');
Route::get('/dashboard/bookings_monthly', ['as' => 'bookings_monthly', 'uses' => 'BookingsController@getBookingMonthly'])->middleware('authSentinel');
Route::get('/dashboard/login', ['as' => 'dashboard_login', 'uses' => 'AdminController@getLogin']);

/******************Client module*****************/

Route::get('/dashboard/clients', ['as' => 'clients', 'uses' => 'ClientsController@getClientTable'])->middleware('authSentinel');
Route::get('/data/clients', 'ClientsController@getData')->middleware('authSentinel');

Route::get('/dashboard/clients/view/{id}', 'ClientsController@getBooking')->middleware('authSentinel');
Route::get('/dashboard/clients/edit/{id}', 'ClientsController@editClient')->middleware('authSentinel');
Route::post('/dashboard/clients/saveEdit/', 'ClientsController@saveEdit')->middleware('authSentinel');
Route::get('/forms/client/add', 'ClientsController@getAddForm')->middleware('authSentinel');
Route::get('/forms/client/import', 'ClientsController@getImportCLient')->middleware('authSentinel');
Route::post('/data/clients/save', 'ClientsController@save')->middleware('authSentinel');
Route::post('/data/clients/import_client', 'ClientsController@import')->middleware('authSentinel');
Route::get('/forms/client/delete/{id}', 'ClientsController@getDeleteForm')->middleware('authSentinel');
Route::post('/data/client/delete', 'ClientsController@delete')->middleware('authSentinel');

Route::get('/dashboard/client_monthly', ['as' => 'client_monthly', 'uses' => 'ClientsController@getClientMonthly'])->middleware('authSentinel');




Route::get('/data/bookings', 'BookingsController@getData')->middleware('authSentinel');
Route::get('/data/importer', 'ContactImporterController@getData')->middleware('authSentinel');
Route::post('/data/importer/save', 'ContactImporterController@save')->middleware('authSentinel');
Route::post('/data/importer/edit', 'ContactImporterController@edit')->middleware('authSentinel');
Route::post('/data/importer/delete', 'ContactImporterController@delete')->middleware('authSentinel');
Route::get('/data/users', 'UsersController@getData')->middleware('authSentinel');

Route::post('/dashboard/login/doLogin', 'AuthController@doLogin');
Route::get('/dashboard/login/logout', 'AuthController@logout');

Route::get('/forms/importer/add', 'ContactImporterController@getAddForm')->middleware('authSentinel');
Route::get('/forms/importer/edit/{id}', 'ContactImporterController@getEditForm')->middleware('authSentinel');
Route::get('/forms/importer/delete/{id}', 'ContactImporterController@getDeleteForm')->middleware('authSentinel');
Route::get('/forms/importer/run/{id}', 'ContactImporterController@getRunForm')->middleware('authSentinel');

Route::post('/runimporter', 'ImapController@makeImportPaswd')->middleware('authSentinel');
Route::post('/runimporterNP', 'ImapController@makeImportNoPaswd')->middleware('authSentinel');

Route::get('/dashboard/groups', ['as' => 'groups', 'uses' => 'GroupsController@getAdminTable'])->middleware('authSentinel');
Route::get('/dashboard/groups/view/{id}', 'GroupsController@getGroup')->middleware('authSentinel');
Route::get('/data/groups', 'GroupsController@getData')->middleware('authSentinel');

Route::get('/dashboard/bookings/view/{id}', 'BookingsController@getBooking')->middleware('authSentinel');
Route::get('/dashboard/bookings/cancel_booking/{id}', 'BookingsController@cancelBooking')->middleware('authSentinel');

Route::get('/dashboard/groups/view/{id}', 'GroupsController@getGroup')->middleware('authSentinel');
Route::get('/dashboard/group_monthly', ['as' => 'group_monthly', 'uses' => 'GroupsController@getGroupMonthly'])->middleware('authSentinel');

Route::get('/dashboard/bookings/export/csv', 'BookingsController@exportCSV')->middleware('authSentinel');

Route::get('/dashboard/users/my_account', 'UsersController@getMyAccount')->middleware('authSentinel');
Route::post('/dashboard/users/my_account', 'UsersController@postMyAccount')->middleware('authSentinel');

Route::get('/dashboard/users', 'UsersController@getUsers')->middleware('authSentinel','checkRole:Owner,Admin,Agency Manager');
Route::get('/dashboard/users/edit/{id}', 'UsersController@getEditUser')->middleware('authSentinel','checkRole:Owner,Admin,Agency Manager');
Route::post('/dashboard/users/delete', 'UsersController@delete')->middleware('authSentinel','checkRole:Owner,Admin,Agency Manager');
Route::post('/dashboard/users/activate', 'UsersController@activate')->middleware('authSentinel','checkRole:Owner,Admin,Agency Manager');
Route::get('/forms/users/delete/{id}', 'UsersController@getDeleteForm')->middleware('authSentinel');
Route::get('/forms/users/activate/{id}', 'UsersController@getActivateForm')->middleware('authSentinel');
Route::post('/data/users/save', 'UsersController@save')->middleware('authSentinel');

Route::get('/dashboard/agency', 'AgencyController@getAgency')->middleware('authSentinel','checkRole:Owner');
Route::get('/data/agencies', 'AgencyController@getData')->middleware('authSentinel','checkRole:Owner');
Route::post('/data/agencies/save', 'AgencyController@save')->middleware('authSentinel','checkRole:Owner');
Route::get('/dashboard/agencies/edit/{id}', 'AgencyController@getEditAgent')->middleware('authSentinel','checkRole:Owner');
Route::post('/dashboard/agency/saveEdit', 'AgencyController@saveEdit')->middleware('authSentinel','checkRole:Owner');