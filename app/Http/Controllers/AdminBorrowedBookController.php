<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowedBook;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;

class AdminBorrowedBookController extends Controller
{
    public function index()
    {
        $borrowedBooks = BorrowedBook::with('user', 'book')->latest()->simplePaginate(5);
        return view('borrowed_books.index', compact('borrowedBooks'));
    }


    // Method to display the form
    public function showForm(PhysicalBook $book)
    {

        return view('borrowed_books.create', compact('book'));
    }



    public function store(Request $request, PhysicalBook $book)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
            'due_in_days' => 'required|integer|min:1',
        ]);

        // Check if the book is available
        if ($book->available_copies <= 0) {
            return redirect()->back()->with(['error' => 'Sorry, the book is not available.']);
        }

        // Check if the user has already borrowed this book
        $alreadyBorrowed = BorrowedBook::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($alreadyBorrowed) {
            return redirect()->back()->with(['error' => 'You have already borrowed this book.']);
        }

        $dueInDays = (int) $request->due_in_days;

        // Store the borrowed book
        BorrowedBook::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays($dueInDays),
        ]);

        // Decrement the available_copies column
        $book->decrement('available_copies');

        // Redirect back with success message
        return redirect()->back()->with('success', 'Book borrowed successfully!');
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

    // // Method to handle searching for books
    // public function searchBooks(Request $request)
    // {
    //     $search = $request->get('q');
    //     $books = PhysicalBook::where('title', 'like', "%{$search}%")
    //         ->limit(20)
    //         ->get();

    //     return response()->json($books);
    // }
}
