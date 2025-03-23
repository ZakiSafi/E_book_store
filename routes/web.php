<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OnlineBookController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\BookDownloadController;
use App\Http\Controllers\PhysicalBookController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminBorrowedBookController;
use App\Http\Controllers\AdminBorrowRequestController;


// Public Routes (No Authentication)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books', [OnlineBookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [OnlineBookController::class, 'show'])->name('books.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/physical-books', [PhysicalBookController::class, 'index'])->name('physicalBooks.index');
Route::get('/physical-books/{id}', [PhysicalBookController::class, 'show'])->name('physicalBooks.show');


// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::post('/logout', 'destroy')->name('logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('register.store');
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
    // Admin search controller
    Route::get('/adminSearch', [SearchController::class, 'adminSearch'])->name('adminSearch');

    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // creating new category
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');


    // Books Management
    Route::controller(AdminBookController::class)->prefix('books')->name('books.')->group(function () {
        Route::get('/', 'books')->name('index');
        Route::get('/physicalBooks', 'physicalBooks')->name('physicalBooks');
        Route::get('/pending', 'pendingBooks')->name('pending');
        Route::get('/dueBooks', 'dueBooks')->name('dueBooks');
        Route::get('/shelf/{shelf_no}', 'bookShelfs')->name('shelfs');
        Route::put('/{id}/update-status', 'updateStatus')->name('updateStatus');
    });


    // Users Management
    Route::controller(AdminUserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'users')->name('index');
        Route::get('/{id}/books', 'books')->name('books');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Admin Creation
    Route::controller(CreateAdminController::class)->group(function () {
        Route::get('/create', 'createAdmin')->name('create');
        Route::post('/store', 'createAdminSubmit')->name('create.submit');
    });

    //Admin borrowed books management
    Route::controller(AdminBorrowedBookController::class)->name('borrow-books.')->group(function () {
        Route::get('/borrow-books/index', 'index')->name('index');
        Route::get('/borrowed-book/create', 'showForm')->name('create');
        Route::put('/borrow-book/{id}/update', 'update')->name('update');
        Route::post('/borrow-book/{book}', [AdminBorrowedBookController::class, 'store'])->name('store');
        Route::delete('/borrow-book/{id}/delete', 'destroy')->name('delete');
        Route::get('borrowed-books/history', 'history')->name('history');
        Route::post('/borrow-book/extendDueDate/{id}', 'extendDueDate')->name('extend');
        Route::get('/users/search', 'searchUsers')->name('users.search');
    });


    // Admin Borrow Requests Management
    Route::controller(AdminBorrowRequestController::class)->name('borrow-request.')->group(function () {
        Route::get('/borrowed-books/requests', 'borrowRequestIndex')->name('index');
        Route::put('/borrowed-books/requests/{id}/update', 'update')->name('update');
        Route::delete('/borrowed-books/requests/{id}/delete', 'destroy')->name('delete');
    });

    // Admin Physical Books Management
    Route::controller(PhysicalBookController::class)->prefix('physical-books')->name('physical-books.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{book}/update', 'update')->name('update');
        Route::delete('/{book}', 'destroy')->name('destroy');
    });
});

// User
Route::middleware(['auth', 'userOrAdmin'])->prefix('user')->name('user.')->group(function () {

    // Online books management
    Route::resource('books', OnlineBookController::class);


    // Book Management
    Route::get('/books', [UserController::class, 'books'])->name('books');


    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'profile_update'])->name('profile.update');

    // Bookmarks
    Route::controller(BookmarkController::class)->prefix('bookmarks')->name('bookmarks.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}', 'store')->name('store');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Reading & Downloading
    Route::controller(BookDownloadController::class)->group(function () {
        Route::get('/download/{id}', 'download')->name('book.download');
        Route::get('/books/{id}/read', 'read')->name('book.read');
        Route::get('/books/{id}/read/pdf', 'readPdf')->name('books.read.pdf');
    });
});

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {

    //User dashboard
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    // sending request to admin for borrowing book
    Route::post('/borrowed-books/requests/{id}/store', [AdminBorrowRequestController::class, 'store'])->name('borrow-request.store');
});

// Api routes
Route::prefix('api')->group(function () {
    Route::get('/books-borrowed', [ChartController::class, 'getBooksBorrowedData']);
    Route::get('/books-downloaded', [ChartController::class, 'getBooksDownloadedData']);
});


// // filepath: c:\xampp\htdocs\E_book_store\routes\web.php

// Route::get('/send-test-email', function () {
//     Mail::raw('This is a test email', function ($message) {
//         $message->to('test@example.com')
//             ->subject('Test Email');
//     });

//     return 'Test email sent!';
// });
