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

Auth::routes();

Route::get('/', 'HomeController@index'); // TODO: Temporary fix needs to look for a method that redirects to login form.
Route::get('/home', 'HomeController@index')->name('home');

// User routes
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users.delete');
Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');

// Notification routes
Route::get('/notifications', 'NotificationsController@index')->name('notifications.index'); 
Route::get('/notifications/read/all', 'NotificationsController@markAllAsRead')->name('notifications.read.all');

// Account settings routes
Route::get('account/{type}', 'AccountSettingsController@index')->name('account.settings');
Route::post('account/info', 'AccountSettingsController@editInfo')->name('account.settings.info');
Route::post('account/security', 'AccountSettingsController@editSecurity')->name('account.settings.security');

// Ticket controller routes
Route::get('/tickets/dashboard', 'TicketController@index')->name('tickets.index');
Route::get('/tickets/create', 'TicketController@create')->name('ticket.create');
Route::post('/tickets/store', 'TicketController@store')->name('ticket.store');

// Helpdesk status routes 
Route::get('/helpdesk/status', 'StatusController@index')->name('status.index');
Route::get('/helpdesk/status/create', 'StatusController@create')->name('status.create');
Route::get('/helpdesk/status/edit/{id}', 'StatusController@edit')->name('status.edit');
Route::get('/helpdesk/status/delete/{id}', 'StatusController@destroy')->name('status.delete');
Route::post('/helpdesk/status/store', 'StatusController@store')->name('status.store');

// Permission routes
Route::get('/permissions', 'PermissionController@index')->name('acl.index');

// API Key controller
Route::get('/apikeys', 'ApiKeyController@index')->name('apikeys.index');
Route::get('/apikeys/delete/{id}', 'ApiKeyController@delete')->name('apikeys.delete');
Route::post('/apikeys/create', 'ApiKeyController@store')->name('apikeys.store');

// Subscription routes
Route::get('/subscriptions', 'SubscriptionController@index')->name('inschrijvingen.index');

// Product routes
Route::get('/products', 'ProductsController@index')->name('producten.index');

// Log routes
Route::get('/activity', 'LogController@index')->name('logs.index');

// Helpdesk category routes. 
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/create', 'CategoryController@create')->name('categories.create');
Route::get('categories/delete/{id}', 'CategoryController@delete')->name('categories.destroy');
Route::get('categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
Route::post('categories/store', 'CategoryController@store')->name('categories.store');

// Helpdesk priority routes 
Route::get('/priorities', 'PrioritiesController@index')->name('priorities.index');
Route::get('/priorities/create', 'PrioritiesController@create')->name('priorities.create');
Route::get('/priorities/edit/{id}', 'PrioritiesController@edit')->name('priorities.edit');
Route::get('/priorities/delete/{id}', 'PrioritiesController@destroy')->name('priorities.destroy'); 
Route::post('/priorities/store', 'PrioritiesController@store')->name('priorities.store');