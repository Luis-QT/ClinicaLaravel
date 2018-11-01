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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::namespace('Admin')->group(function () {
    Route::resource('/admin/specialties', 'SpecialtyController');
    Route::resource('/admin/profiles', 'ProfileController');
    Route::resource('/admin/users', 'UserController');
});

Route::group(['middleware'=>'auth'], function(){
	Route::namespace('Patient')->group(function(){
		Route::resource('/patients','PatientController');
		Route::post('/patients/search','PatientController@search')->name('searchPatient');
	});
});

