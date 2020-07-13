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
Route::get('/', 'HomeController@index');

Auth::routes([
  
    'register' => false,
    'verify' => false,
    'reset' => false
  ]);


Route::group(['middleware' => ['auth']],function ()
{
Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/logout',function(){

        return back();
    });

//department
  
Route::resource('departments','cpanel\DepartmentsController'); 
 
Route::get('departments/{id}/delete','cpanel\DepartmentsController@destroy');

//Jobs 
Route::resource('jobs','cpanel\JobsController'); 
Route::get('jobs/{id}/delete','cpanel\JobsController@destroy');
 


//bonuses

Route::resource('bonuses','cpanel\BonusesController'); 
 Route::get('bonuses/{id}/delete','cpanel\BonusesController@destroy');


 //employee
Route::resource('employee','cpanel\EmployeeController'); 
Route::get('employee/{id}/delete','cpanel\EmployeeController@destroy');
 

//permission
Route::resource('permission','cpanel\PermissionController'); 


//settings
Route::get('settings','cpanel\SettingController@setting');
Route::post('settings','cpanel\SettingController@setting_save');


//vacations
Route::get('vacations','cpanel\vacations@vacations');
Route::post('vacations','cpanel\vacations@vacations_save');

//workplaces
Route::resource('workplaces','cpanel\WorkplaceController');
Route::get('workplaces/{id}/delete','cpanel\WorkplaceController@destroy');

//official vacations
Route::resource('officialvacations','cpanel\OfficialvacationsController');
Route::get('officialvacations/{id}/delete','cpanel\OfficialvacationsController@destroy');

//shifts

Route::resource('shifts','cpanel\ShiftsController');
Route::get('shifts/{id}/delete','cpanel\ShiftsController@destroy');

//shift settings
Route::get('shiftsettings/{id}','cpanel\ShiftSettingsController@viewShiftSettings');
Route::get('shiftsettings/{id}/edit','cpanel\ShiftSettingsController@edit');
Route::post('shiftsetting/update/{id}','cpanel\ShiftSettingsController@update');

//set workplace to employee
Route::get('empworkplace/{id}','cpanel\EmpWorkplaceController@getAllWorkPlaces');
Route::post('empworkplace/{id}','cpanel\EmpWorkplaceController@setWorkPlaces');

//set shifts to employee
Route::get('empshifts/{id}','cpanel\EmpShiftController@getAllShifts');
Route::post('empshifts/{id}','cpanel\EmpShiftController@setShifts');


//Ask permission
    Route::resource('askpermission','cpanel\AskPermissionController');


    //Vacation Request

    Route::resource('vacationrequest','cpanel\VacationRequestController');


    //request list
    Route::resource('requestslist','cpanel\RequestsController');

    //my requests
    Route::get('myrequets','cpanel\myRequestsController@index');
    Route::post('myrequets','cpanel\myRequestsController@store');

    //daily reports

    Route::post('dailyreport','cpanel\DailyReportController@store');
    Route::get('dailyreport','cpanel\DailyReportController@index');

    //mothlyreport

    Route::post('mothlyreport','cpanel\MonthlyReportController@store');
    Route::get('mothlyreport','cpanel\MonthlyReportController@index');
    //archievs

    Route::get('archievs','cpanel\ArchievsController@index');
    Route::post('archievs','cpanel\ArchievsController@store');
    Route::post('addarchievs','cpanel\ArchievsController@insert');
    Route::get('archievs/{id}/delete','cpanel\ArchievsController@destroy');
    Route::get('archievs/{id}/edit','cpanel\ArchievsController@edit_attend');
    Route::post('updatearchievs','cpanel\ArchievsController@update');

    Route::post('import','cpanel\ArchievsController@importExcel');



    // print reports
    Route::get('printdailyreport','cpanel\DailyReportController@export_pdf');


    Route::get('printmonthlyreport','cpanel\MonthlyReportController@export_pdf');

//edit profile

    Route::get('editprofile','cpanel\EditProfile@edit');

    Route::post('editprofile','cpanel\EditProfile@update');



//lang
    Route::get('lang/{lang}',function($lang){

  if(session()->has('lang')){
    session()->forget('lang');
  }
    if($lang =='ar'){
      session()->put('lang','ar');
    }else{
      session()->put('lang','en');

    }
    return back();


});


}

);
