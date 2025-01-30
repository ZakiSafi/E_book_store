<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;
use Monolog\Handler\RollbarHandler;

Route::get('/', [HomeController::class,'index']);

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
});

// User
Route::middleware(['auth'])->group(function(){
    Route::resource('users', UserController::class)->middleware('auth');
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::get('/user/books', [UserController::class, 'books']);
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [UserController::class, 'profile_update'])->name('profile.update');
});

// Resource Controllers
Route::resource('books', BookController::class);

Route::resource('categories', CategoryController::class);

// Custom routes
Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::get('/register', [RegisterController::class, 'create']);

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::post('/bookmarks',[BookmarkController::class,'store']);
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']);
    Route::get('/bookmarks',[BookmarkController::class, 'index']);

});

// Route for search functionality
Route::get('/search', [BookController::class, 'search']);

// book download
Route::get('/download/{id}', [BookController::class, 'download'])->name('book.download');
