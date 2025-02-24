<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowedBook;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;

class AdminBorrowedBookController extends Controller
{


    // Method to display the form
    public function showForm()
    {
        return view('borrowed_books.create');
    }

    // Method to handle storing the borrowed book

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
            'due_in_days' => 'required|integer|min:1',
        ]);

        // Convert due_in_days to an integer
        $dueInDays = (int) $request->due_in_days;

        // Store the borrowed book
        BorrowedBook::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays($dueInDays),
        ]);

        // Redirect back with success message
        return redirect()->route('admin.borrow-books.create')->with('success', 'Book borrowed successfully!');
    }
    // Method to handle searching for users
    public function searchUsers(Request $request)
    {
        $search = $request->get('q');
        $users = User::where('name', 'like', "%{$search}%")
            ->limit(20)
            ->get();

        return response()->json($users);
    }

    // Method to handle searching for books
    public function searchBooks(Request $request)
    {
        $search = $request->get('q');
        $books = PhysicalBook::where('title', 'like', "%{$search}%")
            ->limit(20)
            ->get();

        return response()->json($books);
    }
}
