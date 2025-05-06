<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OnlineBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function books()
    {
        $user = Auth::user();

        /** @var User $user */
        $books = $user->Onlinebooks()->get();
        return view('users.book', compact('books', 'user'));
    }

    // DashboardController.php
    public function index()
    {
        $user = Auth::user();

        return view('users.dashboard', [
            'uploadedBooks' => $user->Onlinebooks()
                ->latest()
                ->take(5)
                ->get(),

            'borrowedBooks' => $user->borrowedBooks()
                ->with('book')
                ->whereNull('returned_at')
                ->where('due_date', '>=', now())
                ->latest()
                ->take(5)
                ->get(),

            'bookmarkedBooks' => $user->bookmarks()
                ->with('book')
                ->latest()
                ->take(10)
                ->get(),

            'lastUploadedBook' => OnlineBook::where('user_id', $user->id)
            ->latest('created_at')
            ->first(),

            'user' => $user

            // Include other existing data...
        ]);
    }
}
