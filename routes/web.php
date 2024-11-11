<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['isVolunteer'])->group(function () {
    Route::group(['prefix' => 'volunteer'], function () {
        Route::get('dashboard', function () {
            return view('volunteer.dashboard');
        })->name('volunteer.dashboard');
    });
});



Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'auth_login'])->name('auth_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register_admin');
Route::post('register', [AuthController::class, 'auth_register'])->name('auth_register');
