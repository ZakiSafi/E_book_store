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
        $borrowedBooksRequests = BorrowRequest::with('user', 'book')
            ->where('status', BorrowRequest::STATUS_PENDING)
            ->latest()
            ->simplePaginate(5);
        return view('borrowed_books.requests', compact('borrowedBooksRequests'));
    }

    public function borrowRequestHistory()
    {
        $borrowedBooksRequestsHistory = BorrowRequest::with('user', 'book')
            ->where('status', BorrowRequest::STATUS_APPROVED)
            ->latest()
            ->simplePaginate(10);
        return view('borrowed_books.requestsHistory', compact('borrowedBooksRequestsHistory'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
        ]);


        // Check if user already made request for the book
        // Check if the user has already borrowed the book or has a pending request
        $existingBorrowRequest = BorrowRequest::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('status', BorrowRequest::STATUS_PENDING)
            ->first();

        if ($existingBorrowRequest) {
            return redirect()->back()->with('error', 'You already made request for this book');
        } else {
            BorrowRequest::create($attributes);
            return redirect()->back()->with('success', 'Your request sent to admin successfully');
        }
    }
}
