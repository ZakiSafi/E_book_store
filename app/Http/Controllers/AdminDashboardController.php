<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\BorrowedBook;
use App\Models\BorrowRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\PhysicalBook;
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
            'digitalBooks' => $this->getDigitalBooksCount(),
            'physicalBooks' => $this->getPhysicalBooksCount(),
            'pendingBooks' => $this->getPendingBooks(),
            'bookmarks' => $this->getBookmarksCount(),
            'booksLast2Days' => $this->getRecentBooks(10),
            'usersLast2Days' => $this->getRecentUsers(10),
            'borrowedBooks' => $this->getCurrentBorrowedBooks(),
            'overDueBooks' => $this->getOverdueBooks(),
            'shelfs' => $this->getShelfNumbers(),
            'categories' => $this->getCategories(),
            'requestForBorrowingBook' => $this->requestForBorrowingBook()
        ]);
    }
    private function getUsersCount()
    {
        return User::count();
    }
    private function getDigitalBooksCount()
    {
        return OnlineBook::count();
    }

    private function getPhysicalBooksCount()
    {
        return PhysicalBook::count();
    }

    private function getBookmarksCount()
    {
        return Bookmark::count();
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
        return OnlineBook::where('status', 'pending')->get();
    }

    private function getCurrentBorrowedBooks()
    {
        return BorrowedBook::whereNull('returned_at')->count();
    }

    private function getOverdueBooks()
    {
        return BorrowedBook::where('due_date', '<=', Carbon::now())->whereNull('returned_at')->get();
    }
    private function getShelfNumbers()
    {
        return PhysicalBook::select('shelf_no')
            ->distinct()
            ->orderByRaw('CAST(shelf_no AS UNSIGNED) ASC')
            ->get();
    }
    private function getCategories(){
        return Category::all();
    }

    private function requestForBorrowingBook(){
        return BorrowRequest::where('status', 'pending')->get();

    }
}
