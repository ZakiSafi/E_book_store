<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function books()
    {
        $books = OnlineBook::with('user','bookmarks')->latest()->simplepaginate(20);
        $totalBooks = OnlineBook::count();
        return view('admin.books', compact('books', 'totalBooks'));
    }
    public function pendingBooks()
    {
        $pendingBooks = OnlineBook::where('status', 'pending')->get();
        return view('admin.pendingBooks', compact('pendingBooks'));
    }
    public function updateStatus(Request $request, $id)
    {
        $book = OnlineBook::findOrFail($id);
        if ($request->action == 'approve') {
            $book->update(['status' => OnlineBook::STATUS_APPROVED]);
        } elseif ($request->action == 'reject') {
            $book->update(['status' => OnlineBook::STATUS_REJECTED]);
        }
        return redirect()->route('admin.books.pending');
    }
}
