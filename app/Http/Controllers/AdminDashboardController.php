<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class AdminDashboardController extends Controller
{
    // Dashboard logic here
    public function index()
    {
        $user = Auth::user();
        return view('admin.dashboard', [
            'user' => $user,
            'users' => $this->getUsersCount(),
            'books' => $this->getBooksCount(),
            'pendingBooks' => $this->getPendingBooks(),
            'bookmarks' => $this->getBookmarksCount(),
            'booksLast2Days' => $this->getRecentBooks(10),
            'usersLast2Days' => $this->getRecentUsers(10)
        ]);
    }
    private function getUsersCount()
    {
        return Cache::remember('users_count', 600, fn() => User::count());
    }
    private function getBooksCount()
    {
        return Cache::remember('books_count', 600, fn() => OnlineBook::count());
    }
    private function getBookmarksCount()
    {
        return Cache::remember('users_count', 600, fn() => Bookmark::count());
    }
    private function getRecentBooks($days)
    {
        return OnlineBook::where('created_at', '>=', Carbon::now()->subDays($days))->count();
    }
    private function getRecentUsers($days)
    {
        return User::where('created_at', '>=', Carbon::now()->subDays($days))->count();
    }
    private function getPendingBooks()
    {
        return OnlineBook::where('status', 'pending')->count();
    }
}
