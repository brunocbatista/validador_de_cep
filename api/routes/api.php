<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ZipCodeController;

Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::get('zip-codes/{zip_code_value}', [ZipCodeController::class, 'details'])->name('zip-code.details');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['as' => 'zip-code.', 'prefix' => 'zip-codes'], function () {
        Route::get('/', [ZipCodeController::class, 'all'])->name('all');
        Route::post('/', [ZipCodeController::class, 'store'])->name('store');
    });
});
