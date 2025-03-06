<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use App\Models\OnlineBook;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function books()
    {
        $searchType = 'Online Books';
        $books = OnlineBook::with('user', 'bookmarks')->latest()->simplepaginate(20);
        $totalBooks = OnlineBook::count();
        return view('admin.books', compact('books', 'totalBooks', 'searchType'));
    }

    public function physicalBooks()
    {
        $searchType = 'Physical Books';
        $books = PhysicalBook::latest()->simplepaginate(20);
        $totalBooks = PhysicalBook::count();
        return view('admin.physical_books', compact('books', 'totalBooks', 'searchType'));
    }


    public function pendingBooks()
    {
        $pendingBooks = OnlineBook::where('status', 'pending')->get();
        return view('admin.pendingBooks', compact('pendingBooks'));
    }

    public function dueBooks(){
        $dueBooks = BorrowedBook::where('due_date', '<', now())->whereNull('returned_at')->get();
        return view('admin.dueBooks',compact('dueBooks'));
    }


    public function updateStatus(Request $request, $id)
    {
        $book = OnlineBook::findOrFail($id);
        if ($request->action == 'approve') {
            $book->update(['status' => OnlineBook::STATUS_APPROVED]);
        } elseif ($request->action == 'reject') {
            $book->update(['status' => OnlineBook::STATUS_REJECTED]);
        }
        return redirect()->route('admin.books.pending')->with('success', 'Book status updated successfully');
    }
}
