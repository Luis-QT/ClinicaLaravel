<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function(){
	Route::post('/login','ApiController@login');
	Route::post('/meetings/{id}/cancel','ApiController@cancelMeeting');

	Route::get('/doctors','ApiController@getAllDoctors');
	Route::get('/patients/{patient_id}/doctors','ApiController@getDoctorsOfPatient');
	Route::get('/patients/{patient_id}/meetings','ApiController@getAllMeetings');
	Route::get('/patients/{patient_id}/pending-meetings','ApiController@getPendingMeetings');
	
	Route::get('/clinic','ApiController@getClinicInformation');
});



