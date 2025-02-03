<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookDownloadController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index']);

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/admin/books', [AdminBookController::class, 'books'])->name('admin.books');
    Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin.users');
});

// User
Route::middleware(['auth', 'user'])->group(function () {
    Route::resource('users', UserController::class)->middleware('auth');
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::get('/user/books', [UserController::class, 'books']);
});

// profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'profile_update'])->name('profile.update');
});

// Resource Controllers
Route::resource('books', BookController::class);

// Route for search functionality
Route::get('/search', [SearchController::class, 'search']);

// book download
Route::get('/download/{id}', [BookDownloadController::class, 'download'])->name('book.download');
Route::get('/books/{id}/read', [BookDownloadController::class, 'read']);
Route::get('/books/{id}/read/pdf', [BookDownloadController::class, 'readPdf'])->name('books.read.pdf');

Route::resource('categories', CategoryController::class);

// Custom routes
Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmarks', [BookmarkController::class, 'store']);
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']);
    Route::get('/bookmarks', [BookmarkController::class, 'index']);
});
