<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Endpoint untuk get all resource patients 
Route::get('/patients', [PatientController::class, 'index']);

// Endpoint untuk add resource patients 
Route::post('/patients', [PatientController::class, 'store']);

// Endpoint untuk get detail resource patient
Route::get('/patients/{id}', [PatientController::class, 'show']);

// Endpoint untuk edit resource patient
Route::put('/patients/{id}', [PatientController::class, 'update']);

// Endpoint untuk delete resource patient
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

// Endpoint untuk search resource patient by name 
Route::get('patients/search/{name}', [PatientController::class, 'search']);

// Endpint untuk get resource patient yang positive
Route::get('patients/status/positive', [PatientController::class, 'positive']);

// Endpint untuk get resource patient yang sembuh
Route::get('patients/status/recovered', [PatientController::class, 'recovered']);

// Endpint untuk get resource patient yang meninggal
Route::get('patients/status/dead', [PatientController::class, 'dead']);
