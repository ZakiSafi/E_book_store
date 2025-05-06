<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowedBook;
use App\Models\BorrowRequest;
use App\Models\PhysicalBook;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;
use function Symfony\Component\String\b;

class AdminBorrowedBookController extends Controller
{
    public function index()
    {
        $searchType = 'Borrowed Books';
        $borrowedBooks = BorrowedBook::with('user', 'book')
            ->whereNull('returned_at')
            ->latest()
            ->simplePaginate(10);
        return view('borrowed_books.index', compact('borrowedBooks', 'searchType'));
    }


    public function history()
    {
        $searchType = 'Borrowed Books History';
        $borrowedBooks = BorrowedBook::with('user', 'book')
            ->where('borrowed_at', '>=', Carbon::now()->subMonth())
            ->latest()
            ->simplePaginate(15);
        return view('borrowed_books.history', compact('borrowedBooks', 'searchType'));
    }


    // Method to display the form
    public function showForm(Request $request)
    {
        $bookId = $request->query('book_id');
        $userId = $request->query('user_id');

        // Fetch the book and user data
        $book = PhysicalBook::find($bookId);
        $user = User::find($userId);

        return view('borrowed_books.create', compact('book', 'user'));
    }



    public function store(Request $request)
    {
        // Validate the request data
        $attributes = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
            'due_in_days' => 'required|integer|min:1',
        ]);

        // Ensure `due_in_days` is an integer
        $dueInDays = (int) $request->due_in_days;

        // Fetch the book
        $book = PhysicalBook::findOrFail($request->book_id);

        // Check if the book is available
        if ($book->available_copies <= 0) {
            return redirect()->back()->with(['error' => 'Sorry, the book is not available.']);
        }

        // Check if the user has already borrowed the book
        $existingBorrow = BorrowedBook::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        // Updating status of user request
        $existingRequest = BorrowRequest::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->where('status', BorrowRequest::STATUS_PENDING)
            ->first();

        if ($existingBorrow) {
            return redirect()->back()->with(['error' => 'You have already borrowed this book.']);
        }

        if($existingRequest){
            $existingRequest->update([
                'status' => BorrowRequest::STATUS_APPROVED,
                'processed_at' => now(),
                'admin_id' => Auth::user()->id,
            ]);
        }


        // Create the borrowed book record
        $attributes['admin_id'] = Auth::id();
        $attributes['borrowed_at'] = now();
        $attributes['due_date'] = now()->addDays($dueInDays);

        BorrowedBook::create($attributes);

        // Decrement the available copies
        $book->decrement('available_copies');

        // Redirect with success message
        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }

    public function extendDueDate(Request $request, $id)
    {
        $request->validate([
            'additional_days' => 'required|integer|min:1',
        ]);

        $borrowedBook = BorrowedBook::findOrFail($id);
        $borrowedBook->update([
            'due_date' => $borrowedBook->due_date->addDays((int)$request->additional_days),
        ]);

        return redirect()->back()->with('success', 'Due date extended successfully!');
    }


    // Updating a borrow book record
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


    // Deleting a borrow book record
    public function destroy($id)
    {
        $borrowedBook = BorrowedBook::findOrFail($id);

        if (is_null($borrowedBook->returned_at)) {
            $book = PhysicalBook::find($borrowedBook->book_id);
            $book->increment('available_copies');
        }

        $borrowedBook->delete();

        return redirect()->back()->with('success', 'Borrowed book record deleted successfully!');
    }





    public function searchUsers(Request $request)
    {
        $search = $request->get('q');
        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('id', $search) // Allow searching by ID
            ->limit(20)
            ->get();

        return response()->json($users);
    }
}
