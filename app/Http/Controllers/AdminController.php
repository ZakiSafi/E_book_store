<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = Cache::remember('users_count', 600, fn() => User::count());
        $books = Cache::remember('books_count', 600, fn() => Book::count());
        $bookmarks = Cache::remember('bookmarks_count', 600, fn() => Bookmark::count());
        return view('admin.dashboard',compact('user','users','books','bookmarks'));
    }
    public function books(){
        return view("admin.books");
    }
    public function users(){
        return view('admin.users');

    }
}
