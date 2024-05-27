<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

// language route
Route::get('/lang', [userController::class, 'language_change']);
// Authentication
Route::post('login', [authController::class, 'login']);
Route::match(['get',  'post'], 'weblogout', [authController::class, 'weblogout']);

Route::get('/login', function () {
    return view('login');
});
Route::get('/notifications', function () {
    return view('notification');
});


Route::middleware('custom')->group(function () {
    Route::get('/setting', [authController::class, 'settingdata']);
    Route::post('updateSettings', [authController::class, 'updateSet']);
    Route::get('/', [authController::class, 'Dashboard']);
    Route::get('help', function () {
        return view('help');
    });






    // customers CRUD
    Route::get('/customers', [userController::class,  'customers']);
    Route::post('/addCustomer', [userController::class,  'addCustomer']);
    Route::get('/delCustomer/{user_id}', [userController::class,  'delCustomer']);
    Route::get('/CustomerUpdateData/{user_id}', [userController::class,  'CustomerUpdateData']);
    Route::post('/CustomerUpdate/{user_id}', [userController::class,  'CustomerUpdate']);
});


Route::get('email', function () {

    return view("emails.parent");
});
