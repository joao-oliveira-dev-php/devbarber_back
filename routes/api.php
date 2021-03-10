<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarberController;


Route::get('/ping', function() {
    return ['pong'=>true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/user', [AuthController::class, 'create']);


Route::middleware('auth:api')->group(function() {

    //Route::get('/random', [BarberController::class, 'createRandom']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);

    Route::get('/user', [UserController::class, 'read']);
    Route::get('/user/favorites', [UserController::class, 'getFavorites']);
    Route::post('/user/favorite', [UserController::class, 'addFavorite']);
    Route::get('/user/appointments', [UserController::class, 'getAppointments']);


    Route::get('/barbers', [BarberController::class, 'list']);
    Route::get('/barber/{id}', [BarberController::class, 'one']);
    Route::post('/barber/{id}/appointment', [BarberController::class, 'setAppointment']);

    Route::get('/search', [BarberController::class, 'search']);

});

