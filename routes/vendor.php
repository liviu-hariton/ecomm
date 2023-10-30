<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

Route::put('change-status', [AdminController::class, 'changeStatus'])->name('change-status');
Route::put('change-featured', [AdminController::class, 'changeFeatured'])->name('change-featured');
Route::put('change-default', [AdminController::class, 'changeDefault'])->name('change-default');

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::resource('shop-profile', VendorShopProfileController::class);

Route::resource('product/image-gallery', ProductImageGalleryController::class);

Route::resource('product/variant/item', ProductVariantItemController::class);
Route::resource('product/variant', ProductVariantController::class);
Route::resource('product', ProductController::class);
