<?php

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
   Route::get('register/admin');
   Route::get('register/driver');
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

Route::get('/users', function () {
    return view('users');
})->middleware(['auth'])->name('users');

Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal();
});

Route::view('/{any}', 'dashboard')
    ->middleware(['auth'])
    ->where('any', '.*');


