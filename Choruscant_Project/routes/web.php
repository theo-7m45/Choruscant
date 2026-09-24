<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])
    ->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/my-constellation', [UserController::class, 'myConstellation'])
    ->middleware('auth')
    ->name('MyConstellation');

Route::get('/discovery/{user}', [UserController::class, 'discovery'])
    ->name('Discovery');