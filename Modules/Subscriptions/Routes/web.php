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

Route::prefix('subscriptions')->group(function() {
    Route::get('/', 'SubscriptionsController@index');
});

Route::post('/subscription/save', [Modules\Subscriptions\Http\Controllers\SubscriptionsController::class, 'store'])->name('subscription.save');
Route::post('/subscription/renew-sub', [Modules\Subscriptions\Http\Controllers\SubscriptionsController::class, 'renew_sub'])->name('subscription.renew');
