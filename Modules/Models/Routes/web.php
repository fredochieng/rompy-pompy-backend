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

Route::prefix('models')->group(function() {
    Route::get('/', 'ModelsController@index');
});

Route::get('/model/add', [Modules\Models\Http\Controllers\ModelsController::class, 'create'])->name('model.add');
Route::get('/model/list', [Modules\Models\Http\Controllers\ModelsController::class, 'index'])->name('models.list');
Route::get('/model/details/{id}', [Modules\Models\Http\Controllers\ModelsController::class, 'details'])->name('model.details');
Route::post('/model/save', [Modules\Models\Http\Controllers\ModelsController::class, 'store'])->name('model.save');
