<?php

use App\Http\Controllers\AddBusinessController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\authController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Models\AddCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddCategoryController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ExperienceReviewController;
use App\Http\Controllers\SubscriptionController;

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
    Route::get('/', [userController::class, 'Dashboard']);
    Route::get('help', function () {
        return view('help');
    });






    // customers CRUD
    Route::get('/customers', [userController::class,  'customers']);
    Route::post('/addCustomer', [userController::class,  'addCustomer']);
    Route::get('/delCustomer/{user_id}', [userController::class,  'delCustomer']);
    Route::get('/CustomerUpdateData/{user_id}', [userController::class,  'CustomerUpdateData']);
    Route::post('/CustomerUpdate/{user_id}', [userController::class,  'CustomerUpdate']);



    Route::get('email', function () {

        return view("emails.parent");
    });

    Route::get('reviewsAndExperience', [ExperienceReviewController::class, 'index']);
    Route::get('addBlog', function () {

        return view("blog_page");
    });

    Route::get('subscriptionPlan', [SubscriptionController::class, 'index']);


    Route::controller(AddCategoryController::class)->group(function () {

        Route::post('addCategory', 'addcategory')->name('addCategory');
        Route::get('categoryList', 'categoryData')->name('categoryData');
        Route::get('deleteCategory/{id}', 'delCategory')->name('deleteCategory');

        Route::post('updateCategory/{id}', 'updateCategory');
    });
    // Route::controller(AddBusinessController::class)->group(function () {

    //     Route::post('addBusiness', 'addBusiness')->name('addBusiness');
    // });

    Route::get('/orders', [AddBusinessController::class,  'getBusOrders']);
    Route::get('/getSingleorders/{id}', [AddBusinessController::class,  'getSingleorders']);
    Route::post('/changeOrderStatus', [AddBusinessController::class,  'changeOrderStatus']);
    Route::get('/saleRequests', [AddBusinessController::class,  'getBusOrders']);


    Route::get('/businesses', [AddBusinessController::class,  'businesses']);
    Route::post('/addBusiness', [AddBusinessController::class,  'addBusiness']);
    Route::get('/deleteBusiness/{id}', [AddBusinessController::class,  'delBusiness']);
    Route::post('/updateBusinessData/{id}', [AddBusinessController::class,  'updateBusiness']);
    Route::get('/singleBusinesses/{id}', [AddBusinessController::class,  'getSingleBusinesses']);
    Route::get('/requestBusiness', [AddBusinessController::class,  'businessRequest']);
    Route::post('/changeBusinessStatus', [AddBusinessController::class,  'changeBusinessStatus']);


    Route::get('/blogs', [BlogsController::class,  'index']);
    Route::post('/addblog', [BlogsController::class,  'insert']);
    Route::post('/upload-image', [BlogsController::class, 'upload'])->name('upload.image');
    Route::get('/getBlogs', [BlogsController::class, 'getBlogs']);
    Route::get('/deleteBlog/{id}', [BlogsController::class, 'delete']);
    Route::get('/editBlog/{id}', [BlogsController::class, 'editBlogData']);
    Route::post('/updateBlog/{id}', [BlogsController::class, 'update']);

    Route::get('/getBlogDetail/{id}', [BlogsController::class, 'getBlogDetail']);


    Route::get('/inquiry', [ContactUsController::class, 'getInquiry']);
    Route::post('/updInqStatus', [ContactUsController::class, 'updateStatus']);
    Route::get('/delinquiry/{id}', [ContactUsController::class, 'delete']);

    Route::post('addSubscription', [SubscriptionController::class, 'insert']);
    Route::get('deleteSubscription/{id}', [SubscriptionController::class, 'delete']);
    Route::get('/editSubscription/{id}', [SubscriptionController::class, 'editSubscriptionData']);
    Route::post('/UpdateSubscription/{id}', [SubscriptionController::class, 'update']);


    // review and Experience
    Route::post('/insertReview', [ExperienceReviewController::class, 'insertReview']);
    Route::post('/insertExperience', [ExperienceReviewController::class, 'insertExperience']);


    Route::get('company', [CompanyController::class, 'company']);
    Route::post('storeCompany', [CompanyController::class, 'store']);
});
