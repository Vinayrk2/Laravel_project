<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdditionalOptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationPromptController;
use Illuminate\Foundation\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CurrencyController;

Route::get('/', [HomeController::class, 'home'])->name('index');
Route::get('/user/signup', [HomeController::class, 'home'])->name('cart');
Route::get('/product/category/{name}', [ProductController::class, 'categorizedProducts'])
    ->name('product-list-categorized');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product-view');
Route::get('/news', [NewsController::class, 'viewNews'])->name('news.index');
Route::get('/aboutus', [AboutController::class, 'aboutPage'])->name('aboutpage');
Route::get('/contactus', [ContactController::class, 'contactPage'])->name('contactpage');


Route::get('/gallery', [AdditionalOptionController::class, 'galleryList'])->name('gallery_list');
Route::get('/gallery/{id}', [AdditionalOptionController::class, 'galleryDetail'])->name('gallery.detail');
Route::get('/service/{id}', [ServiceController::class, 'service'])->name('service');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('signup');
    Route::post('/register', [AuthController::class, 'register'])->name('signup.post');

    // Password Reset Routes
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Routes that require email verification
    Route::middleware(['verified'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        // Add other protected routes here
    });

    // Email Verification Routes (don't need verified middleware)
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

Route::post('/contactus', [ContactController::class, 'submitContact'])->name('contact.submit');

Route::post('/set_currency', [CurrencyController::class, 'setCurrency']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/increment/{id}', [CartController::class, 'incrementQuantity'])->name('cart.increment');
    Route::get('/cart/decrement/{id}', [CartController::class, 'decrementQuantity'])->name('cart.decrement');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/success', function () {
    return view('success', [
        'title' => session('title', 'Success'),
        'message' => session('message', 'Your request was processed successfully.'),
        'buttonText' => session('buttonText', 'Go To Homepage'),
        'redirectRoute' => session('redirectRoute', 'index'),
    ]);
})->name('success');
