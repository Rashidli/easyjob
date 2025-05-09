<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactItemController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SingleController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\WordController;
use App\Http\Controllers\Front\CompanyAuthController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});
Route::get('storage_link', function (){
    return \Illuminate\Support\Facades\Artisan::call('storage:link');
});

Route::get('migrate', function (){
    return \Illuminate\Support\Facades\Artisan::call('migrate');
});

Route::get('cache_reset', function (){
    return \Illuminate\Support\Facades\Artisan::call('permission:cache-reset');
});

Route::get('optimize', function (){
    return \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::group(['prefix' => 'admin'], function (){

    Route::get('/', [PageController::class,'login'])->name('login');
    Route::get('/register', [PageController::class,'register'])->name('register');
    Route::post('/login_submit',[AuthController::class,'login_submit'])->name('login_submit');
    Route::post('/register_submit',[AuthController::class,'register_submit'])->name('register_submit');

    Route::group(['middleware' =>'auth'], function (){

        Route::get('/home', [PageController::class,'home'])->name('home');
        Route::get('/logout',[AuthController::class,'logout'])->name('logout');
        Route::get('toggle-status/{id}',[CompanyController::class,'toggleStatus'])->name('toggle.status');
        Route::resource('users',UserController::class);
        Route::resource('roles',RoleController::class);
        Route::resource('permissions',PermissionController::class);

        Route::resource('blogs',BlogController::class);
        Route::resource('socials',SocialController::class);
        Route::resource('contact_items',ContactItemController::class);
        Route::resource('singles',SingleController::class);
        Route::resource('words',WordController::class);
        Route::resource('images',ImageController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('contacts',ContactController::class);
        Route::resource('tags',TagController::class);
        Route::resource('companies',CompanyController::class);
        Route::resource('vacancies',VacancyController::class);
        Route::resource('abouts',AboutController::class);
        Route::get('/delete-slider-image/{id}', [BlogController::class, 'deleteImage'])
            ->name('delete-slider-image');

    });
});

Route::group(['prefix' => LaravelLocalization::setLocale()], function (){

    Route::get('/favorite-vacancies', [HomeController::class, 'showFavoriteVacancies'])->name('favorite.vacancies');
    Route::get('success',[HomeController::class,'success'])->name('success');
    Route::get('vacancy_post_success',[HomeController::class,'vacancy_post_success'])->name('vacancy_post_success');

    Route::get('/sitemap.xml', [SitemapController::class, 'sitemap']);
    Route::get('/', [HomeController::class,'welcome'])->name('welcome');
    Route::get('{slug}', [HomeController::class,'dynamicPage'])->name('dynamic.page');
    Route::post('/contact_post',[HomeController::class,'contact_post'])->name('contact_post');

    Route::prefix('company')->group(function () {

        Route::get('success', [CompanyAuthController::class,'success'])->name('company.success');
        Route::get('login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
        Route::post('company_login', [CompanyAuthController::class, 'login'])->name('company.login.post');
        Route::get('register', [CompanyAuthController::class, 'showRegistrationForm'])->name('company.register');
        Route::post('company_register', [CompanyAuthController::class, 'register'])->name('company.register.post');
        Route::get('showForgotPasswordForm',[CompanyAuthController::class,'showForgotPasswordForm'])->name('showForgotPasswordForm');
        Route::post('sendResetLink',[CompanyAuthController::class,'sendResetLink'])->name('sendResetLink');
        Route::get('forgot-password', [CompanyAuthController::class, 'showForgotPasswordForm'])->name('company.password.request');
        Route::post('forgot-password', [CompanyAuthController::class, 'sendResetLink'])->name('company.password.email');

        Route::get('reset-password', [CompanyAuthController::class, 'showResetForm'])->name('company.password.reset');
        Route::post('reset-password', [CompanyAuthController::class, 'resetPassword'])->name('company.password.update');

        Route::middleware('auth:company')->group(function () {
            Route::get('dashboard', [CompanyAuthController::class, 'dashboard'])->name('company.dashboard');
            Route::put('update',[CompanyAuthController::class,'update'])->name('company.update');
            Route::post('/company/{id}/upload-logo', [CompanyAuthController::class, 'uploadLogo'])->name('company.upload.logo');
            Route::put('/company/{id}', [CompanyAuthController::class, 'update'])->name('company.update');
            Route::get('/vacancyNew',[CompanyAuthController::class,'newVacancy'])->name('newVacancy');
            Route::get('/vacancyList',[CompanyAuthController::class,'vacancyList'])->name('vacancyList');
            Route::get('/vacancyPending',[CompanyAuthController::class,'vacancyPending'])->name('vacancyPending');
            Route::get('/vacancyReturned',[CompanyAuthController::class,'returnedVacancy'])->name('returnedVacancy');
            Route::post('/vacancy_post',[HomeController::class,'vacancy_post'])->name('vacancy_post');
            Route::get('company_logout', [CompanyAuthController::class,'logout'])->name('company_logout');
            Route::get('vacancy_edit/{id}', [CompanyAuthController::class,'vacancy_edit'])->name('vacancy_edit');
            Route::put('vacancy_update/{id}', [CompanyAuthController::class,'vacancy_update'])->name('vacancy_update');
            Route::get('notices', [CompanyAuthController::class,'notices'])->name('notices');
            Route::get('/notices/{id}', [CompanyAuthController::class, 'markAsRead'])->name('markAsRead');

        });
    });

});
