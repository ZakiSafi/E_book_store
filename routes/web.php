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
// Public Routes (No Authentication)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books', [OnlineBookController::class, 'index']);
Route::get('/books/{book}', [OnlineBookController::class, 'show']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create');
    Route::post('/login', 'store')->name('login');
    Route::post('/logout', 'destroy')->name('logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

// Password Reset
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('password/forgot', 'showForm')->name('password.forgot');
    Route::post('password/forgot', 'sendResetLink')->name('password.forgot.submit');
});
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('password/reset/{token}', 'showForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.reset.submit');
});

// Google Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login/google', 'redirectToGoogleForLogin');
    Route::get('/signup/google', 'redirectToGoogleForSignup');
    Route::get('/login/google/callback', 'handleGoogleCallback');
});

//Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Books Management
    Route::controller(AdminBookController::class)->prefix('books')->name('books.')->group(function () {
        Route::get('/', 'books')->name('index');
        Route::get('/pending', 'pendingBooks')->name('pending');
        Route::put('/{id}/update-status', 'updateStatus')->name('updateStatus');
    });

    // Users Management
    Route::controller(AdminUserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'users')->name('index');
        Route::get('/{id}/books', 'books')->name('books');
        Route::delete('/{id}', 'destroy')->name('destroy'); // Changed from GET to DELETE
    });

    // Admin Creation
    Route::controller(CreateAdminController::class)->group(function () {
        Route::get('/create', 'createAdmin')->name('create');
        Route::post('/store', 'createAdminSubmit')->name('create.submit');
    });
});

// User
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

    // Book Management
    Route::get('/books', [UserController::class, 'books'])->name('books');

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'profile_update'])->name('profile.update');

    // Bookmarks
    Route::controller(BookmarkController::class)->prefix('bookmarks')->name('bookmarks.')->group(function () {
        Route::post('/', 'store')->name('store');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/', 'index')->name('index');
    });

    // Reading & Downloading
    Route::controller(BookDownloadController::class)->group(function () {
        Route::get('/download/{id}', 'download')->name('book.download');
        Route::get('/books/{id}/read', 'read')->name('book.read');
        Route::get('/books/{id}/read/pdf', 'readPdf')->name('books.read.pdf');
    });
});
