<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnlineBookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\BookDownloadController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ForgotPasswordController;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', [HomeController::class, 'index'])->name('home');

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/books', [AdminBookController::class, 'books'])->name('admin.books');
    Route::get('/admin/books/pending', [AdminBookController::class, 'pendingBooks'])->name('books.pending');
    Route::put('/admin/books/{id}/update-status', [AdminBookController::class, 'updateStatus'])->name('admin.books.updateStatus');
    // Admin Users
    Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin.users');
    Route::get('/admin/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/{id}/books', [AdminUserController::class, 'books'])->name('user.books');
    // Admin creation form
    Route::get('/create/admin', [CreateAdminController::class, 'createAdmin'])->name('admin.create');
    Route::post('/store/admin', [CreateAdminController::class, 'createAdminSubmit'])->name('admin.create.submit');
});

// User
Route::middleware(['user'])->group(function () {
    Route::resource('users', UserController::class)->middleware('auth');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

// Read and download books and profile route
Route::middleware(['auth'])->group(function () {
    Route::get('/user/books', [UserController::class, 'books']);
    Route::get('/download/{id}', [BookDownloadController::class, 'download'])->name('book.download');
    Route::get('/books/{id}/read', [BookDownloadController::class, 'read']);
    Route::get('/books/{id}/read/pdf', [BookDownloadController::class, 'readPdf'])->name('books.read.pdf');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'profile_update'])->name('profile.update');
    Route::post('/bookmarks', [BookmarkController::class, 'store']);
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']);
    Route::get('/bookmarks', [BookmarkController::class, 'index']);
});

// Resource Controllers
Route::resource('books', OnlineBookController::class);

// Route for search functionality
Route::get('/search', [SearchController::class, 'search']);


Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Custom routes
Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
// password Reset logic
Route::get('password/forgot', [ForgotPasswordController::class, 'showForm'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLink'])->name('password.forgot.submit');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset.submit');


// loging user using social account
Route::get('/login/google', [LoginController::class, 'redirectToGoogleForLogin']);
Route::get('/signup/google', [LoginController::class, 'redirectToGoogleForSignup']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
