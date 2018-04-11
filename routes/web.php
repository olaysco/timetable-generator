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

Route::get('/', function() {
    return redirect('/dashboard');
});

Route::get('/dashboard', 'DashboardController@index');

// Routes for rooms module
Route::resource('rooms', 'RoomsController');

// Routes for courses module
Route::resource('courses', 'CoursesController');

// Routes for timeslots module
Route::resource('timeslots', 'TimeslotsController');

// Routes for professors module
Route::resource('professors', 'ProfessorsController');

// Routes for college classes
Route::resource('classes', 'CollegeClassesController');

// Routes for timetable generation
Route::post('timetables', 'TimetablesController@store');
Route::get('timetables', 'TimetablesController@index');
Route::get('timetables/view/{id}', 'TimetablesController@view');

// User account activation routes
Route::get('/users/activate', 'UsersController@showActivationPage');
Route::post('/users/activate', 'UsersController@activateUser');

Route::get('/home', 'HomeController@index')->name('home');

// Other account related routes
Route::get('/login', 'UsersController@showLoginPage');
Route::post('/login', 'UsersController@loginUser');
Route::get('/request_reset', 'UsersController@showPasswordRequestPage');
Route::post('/request_reset', 'UsersController@requestPassword');
Route::get('/reset_password', 'UsersController@showResetPassword');
Route::post('/reset_password', 'UsersController@resetPassword');
Route::get('/my_account', 'UsersController@showAccountPage');
Route::post('/my_account', 'UsersController@updateAccount');
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});
