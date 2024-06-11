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
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
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

// Redirect root to login if not authenticated
Route::get('/', function () {
    return Auth::check() ? view('welcome') : redirect('/login');
});

// Authentication routes
Auth::routes();

// Home routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('about'))->name('about');

// Profile routes (only accessible when authenticated)
Route::resource('profile', ProfileController::class)->middleware('auth');

// Public-facing content routes
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('faq', FAQController::class)->only(['index', 'show']);

// User-facing contact form routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/my-messages', [ContactController::class, 'userMessages'])->name('contact.user_messages')->middleware('auth');

// Forum routes
Route::resource('forum', ForumController::class)->only(['index', 'show']);
Route::middleware('auth')->group(function () {
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/reply/{postId}', [ForumController::class, 'storeReply'])->name('forum.reply');
});

// Product routes (only accessible when authenticated)
Route::resource('product', ProductController::class)->middleware('auth');

// Order routes
Route::middleware(['auth'])->group(function () {
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orderdetails/{id}', [OrderController::class, 'show'])->name('order.details');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
});

// Admin routes (only accessible when authenticated and authorized as admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FAQController::class);
    Route::resource('faq_categories', App\Http\Controllers\Admin\FAQCategoryController::class);
    Route::resource('contact', App\Http\Controllers\Admin\ContactController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);

    // Admin order management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');

    // Admin contact management
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');
    Route::post('/contact/reply/{id}', [AdminContactController::class, 'reply'])->name('contact.reply');

    // Admin forum management
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/{id}/edit', [AdminForumController::class, 'edit'])->name('forum.edit');
    Route::patch('/forum/{id}', [AdminForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{id}', [AdminForumController::class, 'destroy'])->name('forum.destroy');
    Route::delete('/forum/reply/{id}', [AdminForumController::class, 'destroyReply'])->name('forum.reply.destroy');
});

