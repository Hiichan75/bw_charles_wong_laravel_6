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
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

// Redirect root to login if not authenticated
Route::get('/', function () {
    // If the user is authenticated, redirect to the welcome page
    if (Auth::check()) {
        return view('news'); // Change 'welcome' to your authenticated user home page
    }
    // Otherwise, redirect to the login page
    return redirect('/login');
});

// Include other routes related to authentication
Auth::routes();

// Home route for authenticated users
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Static about page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Profile routes, accessible only by authenticated users
Route::middleware('auth')->group(function () {
    // Show profile
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    // Edit profile
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Update profile
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

// Resource routes for news management
Route::resource('news', NewsController::class);

// Resource routes for FAQ management
Route::resource('faq', FAQController::class);

// User-facing contact form routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route to display user messages, only accessible by authenticated users
Route::get('/my-messages', [ContactController::class, 'userMessages'])->name('contact.user_messages')->middleware('auth');

// Forum routes
Route::resource('forum', ForumController::class);

Route::middleware('auth')->group(function () {
    // Create a new forum post
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    // Store a new forum post
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    // Show a specific forum post
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    // Store a reply to a forum post
    Route::post('/forum/reply/{postId}', [ForumController::class, 'storeReply'])->name('forum.reply')->middleware('auth');
});

// Product routes, only accessible by authenticated users
Route::resource('product', ProductController::class)->middleware('auth');

// Routes related to order creation and management
Route::get('order/{productId}', [OrderController::class, 'create'])->name('order.create');
Route::post('order/{productId}', [OrderController::class, 'store'])->name('order.store');

// Static about page
Route::view('about', 'about')->name('about');


// Admin-specific routes, prefixed with 'admin' and accessible only by admins
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    // Admin dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User management routes
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Other admin routes for managing news, FAQs, contacts, products, orders, and forums
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FAQController::class);
    Route::resource('faq_categories', App\Http\Controllers\Admin\FAQCategoryController::class);
    Route::resource('contact', App\Http\Controllers\Admin\ContactController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('forum', App\Http\Controllers\Admin\ForumController::class);
});

// Public order routes, accessible by authenticated users
Route::middleware(['auth'])->group(function () {
    // Create a new order
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    // Store a new order
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    // Show order details
    Route::get('/orderdetails/{id}', [OrderController::class, 'show'])->name('order.details');
    // List all orders
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
});

// Admin order routes, prefixed with 'admin' and accessible only by admins
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // List all orders for admin
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    // Show specific order details for admin
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    // Update order status for admin
    Route::patch('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');

    Route::delete('admin/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

});

// Admin contact management routes, prefixed with 'admin' and accessible only by admins
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // List all contacts for admin
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contact.index');
    // Show specific contact details for admin
    Route::get('/contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');
    // Reply to a contact for admin
    Route::post('/contact/reply/{id}', [AdminContactController::class, 'reply'])->name('contact.reply');

    Route::delete('admin/contact/{id}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');

});

// Forum management routes, prefixed with 'admin' and accessible only by admins
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    // List all forums for admin
    Route::get('/forum', [App\Http\Controllers\Admin\ForumController::class, 'index'])->name('forum.index');
    // Edit a specific forum for admin
    Route::get('/forum/{id}/edit', [App\Http\Controllers\Admin\ForumController::class, 'edit'])->name('forum.edit');
    // Update a specific forum for admin
    Route::patch('/forum/{id}', [App\Http\Controllers\Admin\ForumController::class, 'update'])->name('forum.update');
    // Delete a specific forum for admin
    Route::delete('/forum/{id}', [App\Http\Controllers\Admin\ForumController::class, 'destroy'])->name('forum.destroy');
    // Delete a specific forum reply for admin
    Route::delete('/forum/reply/{id}', [App\Http\Controllers\Admin\ForumController::class, 'destroyReply'])->name('forum.reply.destroy');
});

// Additional forum management routes, accessible by authenticated and admin users
Route::middleware(['auth', 'admin'])->group(function () {
    // List all forums for admin
    Route::get('/admin/forum', [App\Http\Controllers\Admin\ForumController::class, 'index'])->name('admin.forum.index');
    // other admin routes
});

// User management routes, prefixed with 'admin' and accessible only by admins
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // List all users for admin
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    // Edit a specific user for admin
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    // Update a specific user for admin
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    // Create a new user for admin
    Route::post('/users/create', [UserController::class, 'store'])->name('admin.users.store');
});

// Additional user management routes, prefixed with 'admin' and accessible only by admins
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    // List all users for admin
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    // Update a specific user for admin
    Route::patch('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    // Update a specific user's admin status for admin
    Route::patch('users/{id}/updateAdminStatus', [App\Http\Controllers\Admin\UserController::class, 'updateAdminStatus'])->name('users.updateAdminStatus');
    // Edit a specific user for admin
    Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    // Delete a specific user for admin
    Route::delete('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    // Create a new user for admin
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    // Store a new user for admin
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
});
