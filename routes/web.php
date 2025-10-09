<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PaymentController;
use App\Models\Cart;
use App\Models\Inventory;

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
        Route::get('/restock', [StaffController::class, 'restock'])->name('restock');
        Route::post('/restocking/{id}', [InventoryController::class, 'restocking'])->name('restocking');
    });

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/edit', [StaffController::class, 'edit'])->name('edit');
        Route::post('/status/{id}',[PaymentController::class, 'status'])->name('status');
        Route::put('/orders/{id}/status', [StaffController::class, 'updateStatus'])->name('updateStatus');
    });

    // Graph-related routes
    Route::prefix('graph')->name('graph.')->group(function () {
        Route::get('/bar', [StaffController::class, 'bar'])->name('bar');
        Route::get('/line', [StaffController::class, 'line'])->name('line');
        Route::get('/pie', [StaffController::class, 'pie'])->name('pie');
    });
});


Route::prefix('cashier')->name('cashier.')->middleware('checkrole:4')->group(function(){
    // Profile route
    Route::get('/profile', [CashierController::class, 'profile'])->name('profile');
    Route::put('/image', [CashierController::class, 'image'])->name('image');
    // User-related routes

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/edit', [CashierController::class, 'edit'])->name('edit');
        Route::post('/status/{id}',[PaymentController::class, 'status'])->name('status');
    });
});

Route::prefix('kitchen')->name('kitchen.')->middleware('checkrole:5')->group(function(){
    // Profile route
    Route::get('/profile', [KitchenController::class, 'profile'])->name('profile');
    Route::put('/image', [KitchenController::class, 'image'])->name('image');
    // User-related routes

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/edit', [KitchenController::class, 'edit'])->name('edit');
        Route::put('/orders/{id}/status', [KitchenController::class, 'updateStatus'])->name('updateStatus');
    });
});

Route::prefix('inventory')->name('inventory.')->middleware('checkrole:6')->group(function(){
    // Profile route
    Route::get('/profile', [InventoryController::class, 'profile'])->name('profile');
    Route::put('/image', [InventoryController::class, 'image'])->name('image');
    // User-related routes

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/inventory', [InventoryController::class, 'inventory'])->name('edit');
        Route::get('/inventory/search', [InventoryController::class, 'search'])->name('search');
        Route::get('/export-csv', [InventoryController::class, 'exportCSV'])->name('exportCSV');
    });

    Route::prefix('graph')->name('graph.')->group(function () {
        Route::get('/bar', [InventoryController::class, 'bar'])->name('bar');
        Route::get('/line', [InventoryController::class, 'line'])->name('line');
        Route::get('/pie', [InventoryController::class, 'pie'])->name('pie');
    });
});


Route::prefix('/customer')->name('customer.')->middleware('checkrole:3')->group(function(){
    Route::get('/menu', [CustomerController::class,'index'])->name('index');   
    Route::get('/cart',[CustomerController::class,'cart'])->name('cart');
    Route::get('/delivery',[CustomerController::class,'delivery'])->name('delivery');
    Route::post('/store', [CartController::class,'storeToCart'])->name('storeToCart');
    Route::put('/cart-items/{id}', [CartItemController::class, 'updateQuantity'])->name('quantity');
    Route::delete('/cart-items/{id}', [CartItemController::class, 'deleteItems'])->name('removeItem');
    Route::post('/payment',[PaymentController::class, 'payment'])->name('payment');
    Route::get('/history',[CustomerController::class, 'history'])->name('history');
});
