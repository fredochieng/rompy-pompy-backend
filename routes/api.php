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
Route::get('/v1/model/profile', [App\Api\Controllers\ProfileApiController::class, 'get_model_profile']);
Route::post('/v1/model/profile/update', [App\Api\Controllers\ProfileApiController::class, 'model_update_profile']);
Route::get('/v1/model/get-subscriptions', [App\Api\Controllers\ProfileApiController::class, 'get_model_subscriptions']);
Route::post('/v1/model/change-password', [App\Api\Controllers\ProfileApiController::class, 'change_password']);



