<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowedBook;
use App\Models\PhysicalBook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminBorrowedBookController extends Controller
{
    public function index()
    {
        $searchType = 'Borrowed Books';
        $borrowedBooks = BorrowedBook::with('user', 'book')->whereNull('returned_at')->latest()->simplePaginate(5);
        return view('borrowed_books.index', compact('borrowedBooks', 'searchType'));
    }


    public function history()
    {
        $searchType = 'Borrowed Books History';
        $borrowedBooks = BorrowedBook::with('user', 'book')->latest()->simplePaginate(5);
        return view('borrowed_books.history', compact('borrowedBooks', 'searchType'));
    }


    // Method to display the form
    public function showForm(PhysicalBook $book)
    {

        return view('borrowed_books.create', compact('book'));
    }



    public function store(Request $request, PhysicalBook $book)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
            'due_in_days' => 'required|integer|min:1',
        ]);

        if ($book->available_copies <= 0) {
            return redirect()->back()->with(['error' => 'Sorry, the book is not available.']);
        }

        $alreadyBorrowed = BorrowedBook::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($alreadyBorrowed) {
            return redirect()->back()->with(['error' => 'You have already borrowed this book.']);
        }

        $dueInDays = (int) $request->due_in_days;

        BorrowedBook::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays($dueInDays),
        ]);

        $book->decrement('available_copies');

        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }


    public function extendDueDate(Request $request, $id)
    {
        $request->validate([
            'additional_days' => 'required|integer|min:1',
        ]);

        $borrowedBook = BorrowedBook::findOrFail($id);
        $borrowedBook->update([
            'due_date' => $borrowedBook->due_date->addDays($request->additional_days),
        ]);

        return redirect()->back()->with('success', 'Due date extended successfully!');
    }



    public function update($id)
    {
        $borrowedBook = BorrowedBook::findOrFail($id);

        $borrowedBook->update([
            'is_returned' => true,
            'returned_at' => now(),
        ]);

        $book = PhysicalBook::find($borrowedBook->book_id);
        $book->increment('available_copies');

        return redirect()->route('admin.borrow-books.index')->with('success', 'Borrowed book returned successfully!');
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
}
