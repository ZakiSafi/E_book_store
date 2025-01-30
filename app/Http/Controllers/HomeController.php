<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::take(8)->get();
        $books = Book::latest()->take(12)->get();
        $mostdownloaded = Book::orderBy('downloads', 'desc')->take(12)->get();
        return view('index', compact('categories', 'books', 'mostdownloaded'));
    }
}
