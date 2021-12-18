<?php

use App\Http\Controllers\Api\AssignDriverToOrder;
use App\Http\Controllers\Api\CargoTypeController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\ManagerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderStatusController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\VehicleTypeController;
use App\Http\Resources\UserResource;
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
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('user', function (Request $request) {
        return UserResource::make($request->user());
    });

    Route::apiResource('orders', OrderController::class)->except('destroy');
    Route::put('orders/{order}/status', OrderStatusController::class)->name('orders.status.update');
    Route::put('orders/{order}/driver', AssignDriverToOrder::class)->name('orders.drivers.update');

    Route::apiResource('cargo-types', CargoTypeController::class);
    Route::apiResource('vehicle-types', VehicleTypeController::class);
    Route::apiResource('cities', CityController::class)->only('index');
    Route::apiResource('settings', SettingsController::class)->only('index', 'store');

    Route::group(['middleware' => 'can:executeAsManager'], function () {
        Route::apiResource('managers', ManagerController::class)->only('index');
        Route::post('invite/manager', [ManagerController::class, 'invite'])->name('invite.manager');
        Route::apiResource('drivers', DriverController::class)->only('index');
        Route::post('invite/driver', [DriverController::class, 'invite'])->name('invite.driver');
        Route::apiResource('clients', ClientController::class)->only('index');
    });
});


