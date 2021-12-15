<?php

use App\Http\Controllers\Auth\RegisterDriverController;
use App\Http\Controllers\Auth\RegisterManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'signed'], function () {
   Route::get('register/manager', [RegisterManagerController::class, 'create'])->name('register.manager');
   Route::get('register/driver', [RegisterDriverController::class, 'create'])->name('register.driver');
    Route::post('register/manager', [RegisterManagerController::class, 'store'])->name('register.manager.store');
    Route::post('register/driver', [RegisterDriverController::class, 'store'])->name('register.driver.store');
});

Route::get('/orders', function () {
    return view('orders');
})->middleware(['auth'])->name('orders');

Route::get('/cargo-types', function () {
    return view('cargo-types');
})->middleware(['auth'])->name('cargo-types');

Route::get('/vehicle-types', function () {
    return view('vehicle-types');
})->middleware(['auth'])->name('vehicle-types');

Route::get('/managers', function () {
    return view('managers');
})->middleware(['auth'])->name('managers');

Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal();
});

Route::view('/{any}', 'dashboard')
    ->middleware(['auth'])
    ->where('any', '.*');


