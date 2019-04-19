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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('medicalspecialties', 'MedicalSpecialtiesController@GetallSpcecialties')->middleware('apilang');
Route::get('getSpecializations/{specializations_id}/{type}/{user_id}/{city_id}/{zone_id}/{lat}/{long}', 'MedicalSpecialtiesController@GetSpecializations')->middleware('apilang');
Route::get('search/{keyword}/{user_id}/{type}/{city_id}/{zone_id}', 'MedicalSpecialtiesController@Search')->middleware('apilang');

// users
Route::post('register/{lang}', 'UsersController@Register');
Route::post('login/{lang}', 'UsersController@Login');
Route::post('facebooklogin', 'UsersController@FaceBookLogin');
Route::post('twitterlogin', 'UsersController@TwitterLogin');
Route::post('instgramlogin', 'UsersController@InstgramLogin');
Route::post('forgetpassword/{lang}', 'UsersController@ForegetPassword');
Route::put('updateuser_token/{id}', 'UsersController@UpdateUserToken');
Route::get('push_test/{title}/{token}','UsersController@pushAndroid');
// users end

/*fav*/

Route::get('myfavlist/{id}', 'FavouriteController@GetMyfavourit')->middleware('apilang');
Route::post('addtofavourit/{lang}', 'FavouriteController@AddToFavourit');
Route::delete('deletefrommylist/{id}', 'FavouriteController@DeleteFromFavourit');
/*fav*/

/* docotors Resrvations*/

Route::get('getmyresevationslist/{id}', 'ReservationsController@GetMyReservationsList')->middleware('apilang');
Route::get('avaliabletime/{id}', 'ReservationsController@GetDoctorsCalndars')->middleware('apilang');
Route::post('createresvations', 'ReservationsController@CreateReservations');
Route::post('ratedoctors', 'ReservationsController@RateDoctors');
Route::delete('cancelreservations/{id}', 'ReservationsController@CancelReservations');

/*end*/

/*city*/
Route::get('getcity', 'CityController@GetCity')->middleware('apilang');
  Route::get('getcity/{id}', 'CityController@nearplaces');
/*end*/
/*zone*/
Route::get('getzone/{id}', 'ZoneController@getZone')->middleware('apilang');
/*end*/


/* Static Content*/


Route::get('about_app', 'StaticContentController@GetAboutApp')->middleware('apilang');
Route::get('contact_us', 'StaticContentController@getContactUs')->middleware('apilang');
Route::get('terms_condition', 'StaticContentController@GetTermsCondition')->middleware('apilang');
Route::get('socialmedia', 'StaticContentController@SocialMedia');

/*end*/

/* Join As Doctors*/
Route::post('joinusasdoctor', 'JoinUsController@JoinUsAsDoctor');
Route::post('joinusashospital', 'JoinUsController@JoinUsAsHospital');
/*end*/

// Show Advs 
Route::get('showadvirtisment','AdvsController@showAds'); 
//////////////////////////////////////////////////////////////////
Route::get('services/{lat}/{lng}','MedicalSpecialtiesController@distanceQuery');
Route::get('service/{lat}/{lng}','MedicalSpecialtiesController@getAllServices');