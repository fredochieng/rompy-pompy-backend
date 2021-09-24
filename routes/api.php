<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/v1/login', [App\Api\Controllers\LoginApiController::class, 'login']);
Route::post('/v1/logout', [App\Api\Controllers\LoginApiController::class, 'logout']);
Route::get('/v1/models/vip', [App\Api\Controllers\ModelsApiController::class, 'get_vip_models']);
Route::get('/v1/models/regular', [App\Api\Controllers\ModelsApiController::class, 'get_regular_models']);

/** Get models after filtering city */
Route::get('/v1/models/vip/city/{city_id}', [App\Api\Controllers\ModelsApiController::class, 'get_city_vip_models']);
Route::get('/v1/models/regular/city/{city_id}', [App\Api\Controllers\ModelsApiController::class, 'get_city_regular_models']);

/** Get model services and availabilities */
Route::get('/v1/model/get-services/{model_no}', [App\Api\Controllers\ProfileApiController::class, 'get_model_services']);
Route::get('/v1/model/get-availabilities/{model_no}', [App\Api\Controllers\ProfileApiController::class, 'get_model_availabilities']);

Route::get('/v1/model/profile/{model_no}', [App\Api\Controllers\ProfileApiController::class, 'get_model_profile']);

Route::post('/v1/model/profile/update/{model_no}', [App\Api\Controllers\ProfileApiController::class, 'model_update_profile']);
Route::post('/v1/model/profile/add-services', [App\Api\Controllers\ProfileApiController::class, 'add_model_services']);
Route::post('/v1/model/profile/add-availabilities', [App\Api\Controllers\ProfileApiController::class, 'add_model_availability']);
Route::get('/v1/model/get-subscriptions/{model_no}', [App\Api\Controllers\ProfileApiController::class, 'get_model_subscriptions']);
Route::post('/v1/model/change-password', [App\Api\Controllers\ProfileApiController::class, 'change_password']);

/** Get services */
Route::get('/v1/services', [App\Api\Controllers\SelectorApiController::class, 'get_services_api']);
Route::get('/v1/availabilities', [App\Api\Controllers\SelectorApiController::class, 'get_availabilities_api']);



