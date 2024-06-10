<?php

use App\Http\Controllers\AddBusinessController;
use App\Http\Controllers\AddCategoryController;
use App\Http\Controllers\authController;
use App\Http\Controllers\ExperienceReviewController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [authController::class, 'login']);
Route::post('register', [authController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [authController::class, 'logout']);
    Route::post('/changepasword', [authController::class, 'changepasword']);
    Route::post('/updateSettings', [authController::class, 'updateSettings']);
    Route::get('/getUserProfile', [authController::class, 'getUserProfile']);
});

// category api

Route::get('/getCategories', [AddCategoryController::class, 'getCategories']);

//Business api

Route::get('/getBusiness', [AddBusinessController::class, 'getBusiness']);


// Experience & Review
Route::post('addExperience', [ExperienceReviewController::class, 'addExperience']);
Route::get('getExperience', [ExperienceReviewController::class, 'getExperience']);

Route::post('addReviews', [ExperienceReviewController::class, 'addReviews']);
Route::get('getReviews', [ExperienceReviewController::class, 'getReviews']);

// contact us data insert
Route::post('addContactUs', [userController::class, 'addContactUs']);
