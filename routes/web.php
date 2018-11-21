<?php
use App\Patient;
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

Route::get('/admin/json',function(){
            $as = Patient::all();
            return json_encode($as);
      });


Route::group(['middleware'=>'auth'], function(){
  Route::namespace('Admin')->group(function () {

      //Exports
      Route::get('/admin/users/exportPDF', 'UserController@exportPDF');
      Route::get('/admin/users/viewPDF', 'UserController@viewPDF');
      Route::get('/admin/users/exportExcel', 'UserController@exportExcel');

      Route::get('/admin/doctors/exportPDF', 'DoctorController@exportPDF');
      Route::get('/admin/doctors/viewPDF', 'DoctorController@viewPDF');
      Route::get('/admin/doctors/exportExcel', 'DoctorController@exportExcel');
      Route::get('/admin/doctors/{id}/modalSchedule', 'DoctorController@modalSchedule');
      Route::post('/admin/doctors/updateSchedule', 'DoctorController@updateSchedule');
      Route::get('/admin/doctors/addSchedule', 'DoctorController@addSchedule');

      Route::get('/admin/meetings/exportPDF', 'MeetingController@exportPDF');
      Route::get('/admin/meetings/viewPDF', 'MeetingController@viewPDF');
      Route::get('/admin/meetings/exportExcel', 'MeetingController@exportExcel');


      //Routes
      Route::resource('/admin/specialties', 'SpecialtyController');
      Route::resource('/admin/offices', 'OfficeController');
      Route::resource('/admin/profiles', 'ProfileController');

      Route::get('/admin/users/{id}/info', 'UserController@info');
      Route::resource('/admin/users', 'UserController');

      Route::get('/admin/doctors/{id}/info', 'DoctorController@info');
      Route::resource('/admin/doctors', 'DoctorController');

      Route::resource('/admin/patients','PatientController');
      Route::post('/admin/patients/search','PatientController@search')->name('searchPatient');

      Route::resource('/admin/meetings','MeetingController');
      Route::post('/admin/meetings/searchBetweenDates','MeetingController@searchBetweenDates');
      Route::post('/admin/meetings/searchByState','MeetingController@searchByState');

      Route::resource('/admin/configurations', 'ConfigurationController');

      Route::get('/admin/reportsbyPatient','ReportByPatientController@index');
      Route::post('/admin/reportsbyPatient','ReportByPatientController@filter');
      
      Route::get('/admin/reportsbyDoctor','ReportByDoctorController@index');
      Route::post('/admin/reportsbyDoctor','ReportByDoctorController@filter');
      
      Route::get('/admin/reportsbyOffice','ReportByOfficeController@index');
      Route::post('/admin/reportsbyOffice','ReportByOfficeController@filter');

      Route::get('/admin/reportsbyCalendar','ReportByCalendarController@index');

  });
});


