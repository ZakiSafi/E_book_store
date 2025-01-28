<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\RoleMiddleware;
use Monolog\Handler\RollbarHandler;

Route::resource('/', HomeController::class);
// Resource Controllers
Route::resource('books', BookController::class);
Route::resource('carts', CartController::class);
Route::resource('categories', CategoryController::class);
Route::resource('payments', PaymentController::class);
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('wishlists', WishlistController::class)->middleware('auth');
//profile routes
Route::get('/users/{id}/profile', [UserController::class, 'profile'])->name('profile.edit');
Route::patch('/users/{id}/update', [UserController::class, 'profile_update'])->name('profile.update');
// Custom routes
Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/user/books', [UserController::class ,'books']);
// Route for search functionality
Route::get('/search', [BookController::class, 'search']);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
// Route::middleware(['auth'])->group(function () {
Route::get('/user/dashboard', [UserController::class, 'index']);
// });

// book download
Route::get('/download/{id}', [BookController::class, 'download'])->name('book.download');
