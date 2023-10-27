<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::put('change-status', [AdminController::class, 'changeStatus'])->name('change-status');
Route::put('change-featured', [AdminController::class, 'changeFeatured'])->name('change-featured');
Route::put('change-approved', [AdminController::class, 'changeApproved'])->name('change-approved');
Route::put('change-default', [AdminController::class, 'changeDefault'])->name('change-default');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

Route::resource('slider', SliderController::class);

Route::resource('category', CategoryController::class);

Route::resource('brand', BrandController::class);

Route::resource('product/image-gallery', ProductImageGalleryController::class);

Route::resource('product/variant/item', ProductVariantItemController::class);
Route::resource('product/variant', ProductVariantController::class);
Route::resource('product', ProductController::class);

Route::resource('vendor-profile', AdminVendorProfileController::class);
