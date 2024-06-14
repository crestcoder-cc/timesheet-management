<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TripRequestController;
use App\Http\Controllers\Api\DriverController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('driver/login',[LoginController::class,'login']);
Route::post('trip-request',[TripRequestController::class,'trip_request']);
Route::get('trip-request-details/{id}',[TripRequestController::class,'request_details'])->name('trip-request-details');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('driver-profile',[DriverController::class,'profile']);
    Route::post('driver-checkin',[DriverController::class,'driver_checkin']);
    Route::get('check_out',[DriverController::class,'check_out']);
    Route::post('change-status',[DriverController::class,'change_status']);
    Route::get('get-trip-driver',[DriverController::class,'get_trip_driver']);
    Route::get('driver-queue',[DriverController::class,'driver_queue']);
    Route::get('trip-complete',[DriverController::class,'trip_complete']);
});









