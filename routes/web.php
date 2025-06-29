<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\AuthenticationController;
use App\Http\Controllers\Frontend\frontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes( );

Route::get('/',[frontendController::class, 'index'])->name('frontend');
Route::get('/auth/login',[AuthenticationController::class, 'login'])->name('auth.login');
Route::post('/auth/login',[AuthenticationController::class, 'login_post'])->name('auth.login');
Route::get('/auth/register',[AuthenticationController::class, 'register'])->name('auth.register');
Route::post('/auth/register',[AuthenticationController::class, 'register_post'])->name('auth.register');

//dashboard
Route::get('/home', [HomeController::class, 'index'])->name('dashboard.home');

//Management
Route::get('/home/management',[ManagementController::class, 'index'])->name('home.management');
Route::post('/home/management/store',[ManagementController::class, 'store_register'])->name('home.management.store.register');

//profile
Route::get('/home/profile',[ProfileController::class, 'index'])->name('home.profile');
Route::post('/home/profile/name/update',[ProfileController::class, 'name_update'])->name('home.profile.name.update');
Route::post('/home/profile/email/update',[ProfileController::class, 'email_update'])->name('home.profile.email.update');
Route::post('/home/profile/password/update',[ProfileController::class, 'password_update'])->name('home.profile.password.update');
Route::post('/home/profile/image/update',[ProfileController::class, 'image_update'])->name('home.profile.image.update');

//category
Route::get('/home/category',[CategoryController::class, 'index'])->name('home.category');
Route::post('/home/category/store',[CategoryController::class, 'store'])->name('home.category.store');
Route::post('/home/category/status/{slug}',[CategoryController::class, 'status'])->name('home.category.status');
Route::get('/home/category/edit/{slug}',[CategoryController::class, 'edit'])->name('home.category.edit');
Route::post('/home/category/update/{slug}',[CategoryController::class, 'update'])->name('home.category.update');
Route::get('/home/category/destoy/{slug}',[CategoryController::class, 'destoy'])->name('home.category.destoy');
