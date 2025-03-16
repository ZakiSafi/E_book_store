<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BorrowedBook;
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
        ->where('status' , BorrowedBook::STATUS_BORROWED)
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
    public function showForm(PhysicalBook $book)
    {

        return view('borrowed_books.create', compact('book'));
    }



    public function store(Request $request, PhysicalBook $book)
    {
        $attributes = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:physical_books,id',
            'due_in_days' => 'required|integer|min:1',
        ]);

        // Ensure `due_in_days` is an integer
        $dueInDays = (int) $request->due_in_days;

        // Check if the book is available
        if ($book->available_copies <= 0) {
            return redirect()->back()->with(['error' => 'Sorry, the book is not available.']);
        }

        // Check if the user has already borrowed the book or has a pending request
        $existingBorrow = BorrowedBook::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($existingBorrow) {
            if ($existingBorrow->status === BorrowedBook::STATUS_BORROWED) {
                return redirect()->back()->with(['error' => 'You have already borrowed this book.']);
            } elseif ($existingBorrow->status === BorrowedBook::STATUS_PENDING) {
                if (Auth::user()->role === 'user') {
                    return redirect()->back()->with(['error' => 'You already have a pending request for this book.']);
                } elseif (Auth::user()->role === 'admin') {
                    // Admin can approve the pending request
                    $existingBorrow->update([
                        'status' => BorrowedBook::STATUS_BORROWED,
                        'admin_id' => Auth::id(),
                        'borrowed_at' => now(),
                        'due_date' => now()->addDays($dueInDays),
                    ]);

                    $book->decrement('available_copies');

                    return redirect()->back()->with('success', 'Book borrowed successfully!');
                }
            }
        }

        // If the user is a regular user, set the status to pending
        if (Auth::user()->role === 'user') {
            $attributes['status'] = BorrowedBook::STATUS_PENDING;
        } else {
            // If the user is an admin, set the status to borrowed directly
            $attributes['status'] = BorrowedBook::STATUS_BORROWED;
        }

        $attributes['admin_id'] = Auth::id();
        $attributes['borrowed_at'] = now();
        $attributes['due_date'] = now()->addDays($dueInDays);

        BorrowedBook::create($attributes);

        // Decrement the available copies only if the status is borrowed
        if ($attributes['status'] === BorrowedBook::STATUS_BORROWED) {
            $book->decrement('available_copies');
        }

        // make redirect messages based on the users role
        if (Auth::user()->role === 'user') {
            return redirect()->back()->with('success', 'Your request has been successfully sent to the admin.');
        } else {
            // If the user is an admin, set the status to borrowed directly
            return redirect()->back()->with('success', 'Book borrowed successfully!');
        }


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


    // notify user for overdue books
    public function notifyOverdueUsers()
    {
        $overdueBooks = BorrowedBook::with('user', 'book')
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->get();

        foreach ($overdueBooks as $borrowedBook) {
            // Send notification to the user
            // Example: Mail::to($borrowedBook->user->email)->send(new OverdueBookNotification($borrowedBook));
        }

        return redirect()->back()->with('success', 'Notifications sent successfully!');
    }


    // method to show statistics about the borrowed books
    public function borrowRequests()
    {
        $borrowedBooksRequests = BorrowedBook::with('user', 'book')
            ->where('status', BorrowedBook::STATUS_PENDING)
            ->latest()
            ->simplePaginate(5);
        return view('borrowed_books.requests',compact('borrowedBooksRequests'));
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
