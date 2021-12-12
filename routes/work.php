<?php
use Illuminate\Support\Facades\Route;




////////////////////////////////////////////////////////// register driver . /////////////////////////////////////
Route::post('/registerDriver', [\App\Http\Controllers\Api\Driver\authRegistationController::class, 'registerDriver']);
////////////////////////////////////////////////////////// register driver . /////////////////////////////////////

////////////////////////////////////////////////////////// register Helper . /////////////////////////////////////
Route::post('/registerHelper', [\App\Http\Controllers\Api\Helper\authRegistrationController::class, 'registerHelper']);
////////////////////////////////////////////////////////// register Helper . /////////////////////////////////////

////////////////////////////////////////////////////////// register Driver and Helper . /////////////////////////////////////
Route::post('/registerBothHD', [\App\Http\Controllers\Api\Driver\authRegistationController::class, 'registerBothHD']);
Route::post('/login', [\App\Http\Controllers\Api\Driver\authRegistationController::class, 'login']);
////////////////////////////////////////////////////////// register Driver and Helper . /////////////////////////////////////

///////////////////////////////////////////////////////Cities and OrdersPlaces/////////////////////////////////////////////////////////
Route::get('showCities' , [\App\Http\Controllers\Api\DriverHelperApp\OrderAreaController::class , 'showCities']);
Route::get('showOrderPlaces' , [\App\Http\Controllers\Api\DriverHelperApp\OrderAreaController::class , 'showOrderPlaces']);
///////////////////////////////////////////////////////Cities and OrdersPlaces/////////////////////////////////////////////////////////


Route::middleware('auth:sanctum')->group( function () {

///////////////////////////////////////////////////////work Times/////////////////////////////////////////////////////////
  Route::apiResource('workTimes' , \App\Http\Controllers\Api\DriverHelperApp\WorkTimesController::class);
///////////////////////////////////////////////////////work Times/////////////////////////////////////////////////////////

  ///////////////////////////////////////////////////////Update  Driver and Helper /////////////////////////////////////////////////////////
  Route::post('updateDriver', [\App\Http\Controllers\Api\Driver\UpdateDriverInformationController::class, 'updateDriver']);
  Route::post('updateDriverImage', [\App\Http\Controllers\Api\Driver\UpdateDriverInformationController::class, 'updateImage']);
  Route::post('DeleteDriverImage', [\App\Http\Controllers\Api\Driver\UpdateDriverInformationController::class, 'deleteImage']);
  Route::post('updateDriverPassword', [\App\Http\Controllers\Api\Driver\UpdateDriverInformationController::class, 'updatePassword']);

  Route::post('updateHelper', [\App\Http\Controllers\Api\Helper\UpdateHelperInformationController::class, 'updateHelper']);
  Route::post('updateHelperImage', [\App\Http\Controllers\Api\Helper\UpdateHelperInformationController::class, 'updateImage']);
  Route::post('DeleteHelperImage', [\App\Http\Controllers\Api\Helper\UpdateHelperInformationController::class, 'deleteImage']);
  Route::post('updateHelperPassword', [\App\Http\Controllers\Api\Helper\UpdateHelperInformationController::class, 'updatePassword']);
///////////////////////////////////////////////////////work Times/////////////////////////////////////////////////////////

///////////////////////////////////////////////////////my order requests /////////////////////////////////////////////////////////
  Route::get('MyRequestOrders' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'MyRequestOrders']);
  Route::get('AcceptRequestOrders' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'AcceptRequestOrders']);
  Route::get('RefuseRequestOrders' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'RefuseRequestOrders']);
  Route::post('AcceptRequest/{id}' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'acceptRequest']);
  Route::post('RefuseRequest/{id}' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'refuseRequest']);
  Route::post('EndTheOrder/{id}' , [\App\Http\Controllers\Api\DriverHelperApp\OrderRequestsController::class , 'EndTheOrder']);
///////////////////////////////////////////////////////my order requests /////////////////////////////////////////////////////////




});
