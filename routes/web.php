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
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users.delete');
Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');

// Account settings routes
Route::get('account', 'AccountSettingsController@index')->name('account.settings');
Route::post('account/info', 'AccountSettingsController@editInfo')->name('account.settings.info');
Route::post('account/security', 'AccountSettingsController@editSecurity');

// Ticket controller routes
Route::get('/tickets/dashboard', 'TicketController@index')->name('tickets.index');
Route::get('/tickets/create', 'TicketController@create')->name('ticket.create');

// Permission routes
Route::get('/permissions', 'PermissionController@index')->name('acl.index');

// API Key controller
Route::get('/apikeys', 'ApiKeyController@index')->name('apikeys.index');

// Subscription routes
Route::get('/subscriptions', 'SubscriptionController@index')->name('inschrijvingen.index');

// Product routes
Route::get('/products', 'ProductsController@index')->name('producten.index');

// Log routes
Route::get('/activity', 'LogController@index')->name('logs.index');

// Helpdesk category routes. 
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/create', 'CategoryController@create')->name('categories.create');