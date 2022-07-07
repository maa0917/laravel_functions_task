<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class)
    ->only('create', 'store', 'show');
Route::resource('sessions', SessionController::class)
    ->only('create', 'store', 'destroy');
