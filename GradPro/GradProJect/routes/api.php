<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\DoctorController;
use App\Models;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserChoiceController;
#added for model 
use App\Http\Controllers\SensorDataController;

Route::get('/predict', [SensorDataController::class, 'makePrediction']);
Route::post('/store-sensor-data', [SensorDataController::class, 'store']);

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#doctor Api's
Route::controller(DoctorController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('/logout','logout');
    Route::get('doctorinfo','doctorinfo');
    Route::delete('doctors/{id}','destroy'); 
});





#patient api's
Route::controller(PatientController::class)->group(function(){
    Route::post('pregister','pregister');
    Route::post('plogin','plogin');
    Route::post('patients/{id}/form', 'form');
    Route::get('patientinfo','patientinfo');
    Route::post('/plogout','plogout');
    Route::get('search/{Name}','search');
    Route::get('list','list');
    Route::delete('patients/{id}','destroy');
});

#Patient delete according to id 
#Route::delete('patients/{id}', 'PatientController@destroy');


#Radio button screen 
Route::post('/user-choice/{patientId}', [UserChoiceController::class, 'store']);
