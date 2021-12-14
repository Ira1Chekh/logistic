<?php

use App\Http\Controllers\Api\AssignDriverToOrder;
use App\Http\Controllers\Api\CargoTypeController;
use App\Http\Controllers\Api\InviteUserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderStatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleTypeController;
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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('orders', OrderController::class)->except('destroy');
    Route::put('orders/{order}/status', OrderStatusController::class)->name('orders.status.update');
    Route::put('orders/{order}/driver', AssignDriverToOrder::class)->name('orders.drivers.update');
});

Route::apiResource('cargo-types', CargoTypeController::class);
Route::apiResource('vehicle-types', VehicleTypeController::class);

//Route::group(['middleware' => 'can:executeAsManager'], function () {
    Route::apiResource('users', UserController::class)->only('index');
    Route::post('invite-user', InviteUserController::class)->name('invite-user');
//});


