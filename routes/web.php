<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

Route::get('/p/{product:slug}', [ProductController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('product');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/update-qty', [CartController::class, 'updateProductQty'])->name('update-qty');
Route::delete('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::delete('/clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::delete('/clear-coupon', [CartController::class, 'clearCoupon'])->name('clear-coupon');
Route::get('/cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');

Route::get('/cart', [CartController::class, 'cartDetails'])->name('cart');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::prefix('user')->as('user.')->middleware(['auth', 'verified'])->group(function() {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    Route::resource('addresses', UserAddressController::class);

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout/submit', [CheckoutController::class, 'checkoutSubmit'])->name('checkout.submit');
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
});
