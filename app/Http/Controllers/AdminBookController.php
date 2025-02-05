<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function books()
    {
        $books = Book::with('user')->latest()->simplepaginate(20);
        $totalBooks = Book::count();
        return view('admin.books', compact('books', 'totalBooks'));
    }
    public function pendingBooks()
    {
        $pendingBooks = Book::where('status', 'pending')->get();
        return view('admin.pendingBooks', compact('pendingBooks', 'total'));
    }
    public function updateStatus() {}
}
