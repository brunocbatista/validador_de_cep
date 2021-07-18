<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CepController;

Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::get('ceps/{cep_value}', [CepController::class, 'details'])->name('cep.details');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['as' => 'cep.', 'prefix' => 'ceps'], function () {
        Route::get('/', [CepController::class, 'all'])->name('all');
        Route::post('/', [CepController::class, 'store'])->name('store');
    });
});
