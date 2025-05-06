<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all()->take(14);
        $books = OnlineBook::where('status',OnlineBook::STATUS_APPROVED)->latest()->take(16)->get();
        $mostdownloaded = OnlineBook::orderBy('downloads', 'desc')->take(12)->get();
        return view('index', compact('categories', 'books', 'mostdownloaded'));
    }
}
