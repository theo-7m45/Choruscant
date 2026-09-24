<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])
    ->name('/');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/discovery/{user}', [UserController::class, 'discovery'])
    ->name('discovery');

Route::get('/search', [UserController::class, 'search'])
    ->name('search');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/my-constellation', [UserController::class, 'myConstellation'])
        ->name('my-constellation');

    Route::post('/MyConstellation', [MusicController::class, 'create'])
        ->name('musics.store');

    Route::get('/MyConstellation/{music}/edit', [MusicController::class, 'edit_views'])
        ->name('musics.edit');

    Route::post('/MyConstellation/{music}/edit', [MusicController::class, 'edit'])
        ->name('musics.update');

    Route::post('/MyConstellation/{music}/delete', [MusicController::class, 'delete'])
        ->name('musics.delete');
});