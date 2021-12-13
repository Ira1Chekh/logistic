<?php

use App\Http\Controllers\Api\AssignDriverToOrder;
use App\Http\Controllers\Api\CargoTypeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderStatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleTypeController;
use App\Http\Controllers\InviteUserController;
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

Route::apiResource('cargo-types', CargoTypeController::class);
Route::apiResource('vehicle-types', VehicleTypeController::class);
Route::apiResource('users', UserController::class)->only('index');
Route::post('invite-user', InviteUserController::class);
Route::apiResource('orders', OrderController::class)->except('destroy');
Route::put('orders/{order}/status', OrderStatusController::class);
Route::put('orders/{order}/driver', AssignDriverToOrder::class);
