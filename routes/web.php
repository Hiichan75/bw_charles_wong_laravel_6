<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Auth::routes();

// Profile routes
Route::resource('profile', ProfileController::class)->middleware('auth');

// News routes
Route::resource('news', NewsController::class);

// FAQ routes
Route::resource('faq', FAQController::class);

// Contact routes
Route::get('contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

// Forum routes
Route::resource('forum', ForumController::class);
Route::post('forum/{postId}/reply', [ForumController::class, 'storeReply'])->name('forum.storeReply');

// Product routes
Route::resource('product', ProductController::class)->middleware('auth');
Route::get('order/{productId}', [OrderController::class, 'create'])->name('order.create');
Route::post('order/{productId}', [OrderController::class, 'store'])->name('order.store');

// About page
Route::view('about', 'about')->name('about');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FAQController::class);
    Route::resource('contact', App\Http\Controllers\Admin\ContactController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
});

