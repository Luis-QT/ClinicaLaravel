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

Route::post('/loginKit', 'LoginController@login');
Route::get('/logoutKit', 'LoginController@logout');


Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware'=>'auth'], function(){
  Route::namespace('Admin')->group(function () {
      Route::resource('/admin/specialties', 'SpecialtyController');
      Route::resource('/admin/offices', 'OfficeController');
      Route::resource('/admin/profiles', 'ProfileController');
      Route::resource('/admin/users', 'UserController');
      Route::resource('/admin/doctors', 'DoctorController');

      Route::resource('/admin/patients','PatientController');
      Route::post('/admin/patients/search','PatientController@search')->name('searchPatient');

      Route::resource('/admin/meetings','MeetingController');
      Route::post('/admin/meetings/searchBetweenDates','MeetingController@searchBetweenDates');
      Route::post('/admin/meetings/searchByState','MeetingController@searchByState');
  });
});


