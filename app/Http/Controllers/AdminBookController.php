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
        return view('admin.pendingBooks', compact('pendingBooks'));
    }
    public function updateStatus(Request $request,$id) {
        $book = Book::findOrFail($id);
        if($request->action == 'approve'){
            $book->update(['status'=>Book::STATUS_APPROVED]);
        }
        elseif($request->action =='reject'){
            $book->update(['status' => Book::STATUS_REJECTED]);
        }
        return redirect()->route('books.pending');
    }
}
