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

Route::get('/', 'authenticationsController@logout');
///////////////////////////
/// LogIn
//////////////////////////
Route::post('log','authenticationsController@Login');

///////////////////////////
/// AdminPanel****
//////////////////////////
Route::get('Admin/users', function () {
    return view('admin.statistics.users');
});
Route::get('Admin/requests', function () {
    return view('admin.statistics.requests');
});
Route::get('Admin/show', function () {
    return view('admin.statistics.show');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('Admin/ads', function () {
    return view('admin.statistics.ads');
});
Route::get('Admin/addcities', function () {
    return view('admin.statistics.addcities');
});
Route::get('Admin/add', function () {
    return view('admin.statistics.add');
});
Route::get('Admin/addspecialists', function () {
    return view('admin.statistics.addspecialists');
});
///////////////////////////////////////////////////////////////
//the codeof Admin Role
//////////add admins ////////////////////////////////////////
Route::get('Admin/addadmin','admin\create_admins_controller@view');
Route::post('Admin/addadmin','admin\create_admins_controller@insert');
//*/*//*//show/delete/edit admins*/*/*/**/**/*/*/*/*/*/* */
//////////show admin////////////////////////////
Route::get('Admin/showadmins','admin\show_admins@view');
Route::get('Admin/showadmins/{id}','admin\show_admins@delete');
Route::get('Admin/editadmins/{id}','admin\show_admins@view_edit');
Route::post('Admin/editadmins/{id}','admin\show_admins@edit');//////////////////////////////////////////////////
//add Roles////
Route::get('Admin/addroles','admin\create_admins_controller@view_roles');
Route::post('Admin/addroles','admin\create_admins_controller@insert_roles');
/////show/delete/edit roles///////////////////////////////////////////
//show
 Route::get('Admin/showroles','admin\show_roles@view');
 //delete
 Route::get('Admin/d_roles/{id}','admin\show_roles@delete');
//Edit
Route::get('Admin/Editroles/{id}','admin\Edit_role@view');
Route::post('Admin/Editroles/{id}','admin\Edit_role@edit');
//***********bank *//////////////////////////////////////////////
Route::get('Admin/bankaccount', 'admin\bankaccountsController@viewbank');
//show Bank
Route::get('Admin/showbanks','admin\bankaccountsController@view');
//delete
Route::get('Admin/showbanks/{id}','admin\bankaccountsController@remove');
//Edit
Route::get('Admin/Editbanks/{id}','admin\bankaccountsController@edit');
Route::post('Admin/Editbanks/{id}','admin\bankaccountsController@update');
////////////////////////////////////////////////////////
Route::resource('/manager','admin/managerController');
Route::get('/manager/{id}/delete','admin/managerController@destroy');
////////////////adddddddddddddddddddddd Bank/////////////////////////////
Route::get('Admin/addbanks','admin\bankaccountsController@Addbank');
Route::post('Admin/addbanks','admin\bankaccountsController@Add');
////////////////////////////////////////////////////add specialist/////////////////

/////////////////////////////////////////
///////////////////////////
/// ClinicPanel****
//////////////////////////
Route::get('clinic/editdata', function () {
    return view('clinic.editdata');
});
Route::get('clinic/info', function () {
    return view('clinic.info');
});
Route::get('clinic/statistics', function () {
    return view('clinic.statistics');
});
Route::get('clinic/ads', function () {
    return view('clinic.ads');
});

Route::get('clinic/bankaccount', function () {
    return view('clinic.bankaccount');
});

///////////////////////////
/// HospitalPanel****
//////////////////////////
Route::get('hospital/editdata', function () {
    return view('hospital.editdata');
});
Route::get('hospital/info', function () {
    return view('hospital.info');
});
Route::get('hospital/statistics', function () {
    return view('hospital.statistics');
});
Route::get('hospital/bankaccount', function () {
    return view('hospital.bankaccount');
});
Route::get('hospital/location/{id}','hospital\HospitalsController@viewmap' );
Route::post('hospital/location/{id}','hospital\HospitalsController@map');


///////////////////////////
/// AdminPanel
//////////////////////////


Route::get('/accountInfo','admin\bankaccountsController@show') ;
// users page

Route::get('/usersData','admin\usersController@show');
Route::post('/updateUsersData/{id}','admin\usersController@update') ;



// requests page

Route::get('/requestData','admin\usersController@showRequests');
Route::post('/requestUpdate/{id}','admin\usersController@acceptPending') ;
Route::delete('/requestRemove/{id}','admin\usersController@destroy') ;



/// statistics page

Route::get('/admin/statistics', 'admin\statisticsController@getdoctors');
Route::post('/admin/statistics/search', 'admin\statisticsController@searchdoctors')->name('get_doctors');
Route::get('/admin/statistics/specialist', 'admin\statisticsController@Getspecialist')->name('Getspecialist');
Route::post('Admin/addspecialists', 'admin\statisticsController@AddSpecialist');


/// Inputs Zone Page


Route::get('/admin/cities', 'admin\inputsController@Getcities');
Route::post('/admin/cities/add', 'admin\inputsController@addcity')->middleware('apilang');
Route::get('/admin/zones', 'admin\inputsController@showzones');
Route::post('/admin/cities/edit/{id}', 'admin\inputsController@editcity')->middleware('apilang');
Route::delete('/admin/zone/delete/{id}', 'admin\inputsController@deletezone')->middleware('apilang');

/// Inputs Cities Page


Route::get('/requestCities','admin\CitiesController@show')->middleware('apilang');
Route::post('/cities/add', 'admin\CitiesController@store')->middleware('apilang');
Route::post('/cities/edit/{id}', 'admin\CitiesController@edit');
Route::delete('/cities/delete/{id}', 'admin\CitiesController@destroy')->middleware('apilang');

/// Inputs specialists . Cities Page


Route::get('/requestSpecialist','admin\CitiesController@ShowSpecialist')->middleware('apilang');
Route::post('/Specialist/add', 'admin\CitiesController@storeSpecialist')->middleware('apilang');
Route::post('/Specialist/edit/{id}', 'admin\CitiesController@editSpecialist')->middleware('apilang');
Route::delete('/Specialist/delete/{id}', 'admin\CitiesController@destroySpecialist')->middleware('apilang');
Route::post('updatePadding/{ad_id}','admin\usersController@updatepending'); 
Route::post('updateToDate/{ad_id}','admin\usersController@updateToHour'); 
Route::get('admin/getAds/{admin_id}','admin\usersController@showAds')->middleware('apilang');


///////////////////////////
/// ClinicPanel
//////////////////////////

// Info Page
Route::get('/requestDotorId/{user_id}','clinic\ClinicsControllers@getId'); 
Route::get('clinic/requestInfo/{id}','clinic\ClinicsControllers@Show')->middleware('apilang');
Route::get('clinic/requestData/{id}','clinic\ClinicsControllers@ShowData')->middleware('apilang');
Route::get('/requestCity','clinic\ClinicsControllers@ShowCity')->middleware('apilang');
Route::get('/requestDay/{id}','clinic\ClinicsControllers@ShowDay')->middleware('apilang');
Route::get('/requestZone/select/{city_id}','clinic\ClinicsControllers@ShowZone');
Route::post('updateRegion/{doctor_id}','clinic\ClinicsControllers@updateRegion');
Route::post('updateDate/{doctor_id}/{week_id}','clinic\ClinicsControllers@updateDate');
Route::post('updatePhone/{doctor_id}','clinic\ClinicsControllers@updatePhone');
Route::post('updatewaiting/{doctor_id}','clinic\ClinicsControllers@updateWaiting');
Route::delete('/deleteDate/{doctor_id}/{week_id}','clinic\ClinicsControllers@destroy');
Route::post('clinic/addAds/{id}','clinic\ClinicsControllers@addAds');
Route::post('clinic/getAds/{id}','clinic\ClinicsControllers@getAds');
//map
Route::get('/clinic/map/{id}','clinic\ClinicsControllers@viewmap'); 
Route::post('/clinic/map/{id}','clinic\ClinicsControllers@map'); 



//Statistics Clinic page
Route::get('/clinic/statistics/{user_id}', 'clinic\ClinicsControllers@showStatistics');
Route::post('/clinic/statistics/search/{id}', 'clinic\ClinicsControllers@searchdoctors');


///////////////////////////
/// HospitalPanel
//////////////////////////

// Info Page
Route::get('hospital/requestInfo/{id}','hospital\HospitalsController@Show')->middleware('apilang');

Route::get('hospital/requestInfoBranch/{id}','hospital\HospitalsController@ShowBranch')->middleware('apilang');
Route::get('/hospital/requestInfo','hospital\HospitalsController@GetRegion')->middleware('apilang');
Route::get('requestInfoHospitalDoctor/{branch_id}/{hospital_id}','hospital\HospitalsController@ShowDoctor')->middleware('apilang');
Route::get('/requestDay','hospital\HospitalsController@ShowDay')->middleware('apilang');
Route::put('/hospital/updateDate/{doctor_id}/{week_id}','hospital\HospitalsController@update')->middleware('apilang');
Route::delete('/hospital/delete/{id}','hospital\HospitalsController@destroy');
Route::post('hospital/addDoctor/{hospital_id}','hospital\HospitalsController@addDoctor');
// edit page
Route::post('hospital/updateRegion/{branch}','hospital\HospitalsController@updateRegion');
//Route::get('requestInfoBranch/{user_id}','hospital\HospitalsController@showBranchEdit') ;

// statistics page
Route::get('hospital/statistics/{user_id}','hospital\HospitalsController@showDoctorStatistics');
Route::post('hospital/statistics/search/{id}','hospital\HospitalsController@searchDoctors');
Route::get('/requestSpecialist','hospital\HospitalsController@getSpecialist');


//sending notification
Route::get('/myapp/install',  array('as' => 'install', function($key = null)
{
    // if($key == "appSetup_key"){
    try {
        Artisan::call('config:cache');
        echo 'done mcas <br>';
        //Artisan::call('cache:clear');
        //echo 'done cssss<br>';
         Artisan::call('storage:link');
         echo 'done storage linking<br>';
        //Artisan::call('migrate:fresh', ['--seed' => true]);
        //echo 'done seeding<br>';

      //echo '<br>init migrate:install...';
      //Artisan::call('migrate:refresh');
      //echo 'done migrate:install';

    } catch (Exception $e) {
      Response::make($e->getMessage(), 500);
  }
//   }else{
//     App::abort(404);
//   }
}));
