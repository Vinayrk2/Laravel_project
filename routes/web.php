<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdditionalOptionController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('index');
Route::get('/user/signup', [HomeController::class, 'home'])->name('signup');
Route::get('/user/login', [HomeController::class, 'home'])->name('login');
Route::get('/user/profile', [HomeController::class, 'home'])->name('profile');
Route::get('/product/category/{name}', [ProductController::class, 'categorizedProducts'])->name(name: 'product-list-categorized');
Route::get('/product/{id}', [ProductController::class, 'categorizedProducts'])->name('product-view');
Route::get('/news', [NewsController::class, 'viewNews'])->name('view-news');
// Route::get('/news', [NewsController::class, 'viewNews'])->name('view-news');
Route::get('/aboutus', [AboutController::class, 'aboutPage'])->name('aboutpage');
Route::get('/contactus', [ContactController::class, 'contactPage'])->name('contactpage');


Route::get('/gallery', [AdditionalOptionController::class, 'galleryList'])->name('gallery_list');
Route::get('/gallery/{id}', [AdditionalOptionController::class, 'galleryDetail'])->name('gallery.detail');
Route::get('/service/{id}', [ServiceController::class, 'service'])->name('service');

