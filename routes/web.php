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

Route::view('/login', 'users.login');
Route::view('/dashboard', 'dashboard.index');

// Routes for rooms module
Route::resource('rooms', 'RoomsController');

// Routes for courses module
Route::resource('courses', 'CoursesController');

// Routes for timeslots module
Route::resource('timeslots', 'TimeslotsController');