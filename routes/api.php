<?php

use App\Http\Controllers\AddBusinessController;
use App\Http\Controllers\AddCategoryController;
use App\Http\Controllers\authController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ExperienceReviewController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\userController;
use App\Models\AddBusiness;
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
    Route::post('/changepasword', [authController::class, 'changepasword']);
    Route::post('/updateProfile', [authController::class, 'updateSettings']);
    Route::post('logout', [authController::class, 'logout']);
    Route::get('/getUser', [authController::class, 'getUserProfile']);
    Route::get('/getOrders', [AddBusinessController::class, 'getOrders']);
});

// category api

Route::get('/getCategories', [AddCategoryController::class, 'getCategories']);


Route::get('/searchBusiness', [AddBusinessController::class, 'searchBusiness']);

//Business api
Route::post('/addBusiness', [AddBusinessController::class, 'addSellerBusiness']);
Route::get('/getBusiness', [AddBusinessController::class, 'getBusiness']);
Route::get('/getBusiness/{id}', [AddBusinessController::class, 'getBusiness']);
Route::get('/deleteBusiness/{id}', [AddBusinessController::class, 'delBusiness']);
Route::get('/getFilteredBusiness', [AddBusinessController::class, 'getFilteredBusiness']);
Route::post('/orderBusiness', [AddBusinessController::class, 'orderBusiness']);


// Experience & Review
Route::post('addExperience', [ExperienceReviewController::class, 'addExperience']);
Route::get('getExperience', [ExperienceReviewController::class, 'getExperience']);

Route::post('addReviews', [ExperienceReviewController::class, 'addReviews']);
Route::get('getReviews', [ExperienceReviewController::class, 'getReviews']);

// contact us data insert
Route::post('addContactUs', [ContactUsController::class, 'insert']);


Route::get('/getBlogs', [BlogsController::class, 'getBlogs']);
Route::get('/getSubscription', [SubscriptionController::class, 'getSubscriptionData']);

Route::get('/getCompany', [CompanyController::class, 'getCompany']);
