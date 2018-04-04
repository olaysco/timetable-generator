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

Auth::routes();

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

// User account activation routes
Route::get('/users/activate', 'UsersController@showActivationPage');
Route::post('/users/activate', 'UsersController@activateUser');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function() {
    print 'Hi';
    $timetable = App\Models\Timetable::first();
    event(new App\Events\TimetablesGenerated($timetable));
});

Route::get('/load', function() {
    //return PDF::loadFile(base_path().'/storage/app/storage/timetables/timetable_7.html')->setPaper('a4', 'landscape')->stream////('download.pdf');
});