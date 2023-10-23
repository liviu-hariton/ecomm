<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::put('change-status', [AdminController::class, 'changeStatus'])->name('change-status');
Route::put('change-featured', [AdminController::class, 'changeFeatured'])->name('change-featured');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

Route::resource('slider', SliderController::class);
Route::resource('category', CategoryController::class);
Route::resource('brand', BrandController::class);
Route::resource('vendor-profile', AdminVendorProfileController::class);
