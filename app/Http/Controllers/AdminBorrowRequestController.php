<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;

class AdminBorrowRequestController extends Controller
{
    // method to show statistics about the borrowed books
    public function borrowRequestIndex()
    {
        $borrowedBooksRequests = BorrowedBook::with('user', 'book')
            ->where('status', BorrowedBook::STATUS_PENDING)
            ->latest()
            ->simplePaginate(5);
        return view('borrowed_books.requests', compact('borrowedBooksRequests'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
        ]);

        BorrowRequest::create($attributes);

        return redirect()->route('borrowed_books.requests')->with('success', 'Your request sent to admin successfully');
    }
}
