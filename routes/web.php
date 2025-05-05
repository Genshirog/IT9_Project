<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'auth'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/store',[AuthController::class, 'store'])->name('store');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');
Route::prefix('admin')->name('admin.')->middleware('checkrole:1')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    // Profile route
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/image', [AdminController::class, 'image'])->name('image');
    // User-related routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/add', [AdminController::class, 'add'])->name('add');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/search', [AdminController::class, 'search'])->name('search');
    });

    // Graph-related routes
    Route::prefix('graph')->name('graph.')->group(function () {
        Route::get('/bar', [AdminController::class, 'bar'])->name('bar');
        Route::get('/line', [AdminController::class, 'line'])->name('line');
        Route::get('/pie', [AdminController::class, 'pie'])->name('pie');
    });
});

Route::prefix('staff')->name('staff.')->middleware('checkrole:2')->group(function(){
    Route::get('/dashboard', [StaffController::class, 'index'])->name('index');

    // Profile route
    Route::get('/profile', [StaffController::class, 'profile'])->name('profile');
    Route::put('/image', [StaffController::class, 'image'])->name('image');
    // User-related routes
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/add', [StaffController::class, 'add'])->name('add');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::put('/image', [StaffController::class, 'image'])->name('image');
        Route::get('/search', [StaffController::class, 'search'])->name('search');
    });

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/edit', [StaffController::class, 'edit'])->name('edit');
    });

    // Graph-related routes
    Route::prefix('graph')->name('graph.')->group(function () {
        Route::get('/bar', [StaffController::class, 'bar'])->name('bar');
        Route::get('/line', [StaffController::class, 'line'])->name('line');
        Route::get('/pie', [StaffController::class, 'pie'])->name('pie');
    });
});
Route::get('/customer', [CustomerController::class,'index'])->name('customer.index')->middleware('checkrole:3');   