<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;

Route::get('/', [AuthController::class, 'auth'])->name('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard route
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Profile route
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

    // User-related routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/add', [AdminController::class, 'add'])->name('add');
        Route::get('/search', [AdminController::class, 'search'])->name('search');
    });

    // Graph-related routes
    Route::prefix('graph')->name('graph.')->group(function () {
        Route::get('/bar', [AdminController::class, 'bar'])->name('bar');
        Route::get('/line', [AdminController::class, 'line'])->name('line');
        Route::get('/pie', [AdminController::class, 'pie'])->name('pie');
    });
});

Route::get('/staff', [StaffController::class,'index'])->name('staff.index');
Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');   