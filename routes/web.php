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
    if (Auth::check()) {
        return view('welcome'); // Change 'welcome' to your authenticated user home page
    }
    return redirect('/login');
});

// Include other routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

// Profile routes
Route::resource('profile', ProfileController::class)->middleware('auth');

// News routes
Route::resource('news', NewsController::class);

// FAQ routes
Route::resource('faq', FAQController::class);

// User-facing contact form routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// User contact messages
Route::get('/my-messages', [ContactController::class, 'userMessages'])->name('contact.user_messages')->middleware('auth');


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
    Route::resource('faq_categories', App\Http\Controllers\Admin\FAQCategoryController::class);
    Route::resource('contact', App\Http\Controllers\Admin\ContactController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
});

// Public order routes
Route::middleware(['auth'])->group(function () {
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orderdetails/{id}', [OrderController::class, 'show'])->name('order.details');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
        
});
    
    

// Admin order routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});

// Admin contact management routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');
    Route::post('/contact/reply/{id}', [AdminContactController::class, 'reply'])->name('contact.reply');
});