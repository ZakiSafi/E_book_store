<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->with('book')
            ->get();

        return view('bookmarks.index', compact('bookmarks', 'user'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'online_book_id' => 'required|exists:online_books,id',
        ]);

        // Create or find the bookmark
        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'online_book_id' => $request->online_book_id,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Successfully added to Bookmarks');
    }

    public function destroy(Request $request)
    {
        // Validate the request
        $request->validate([
            'online_book_id' => 'required|exists:online_books,id',
            'redirect_url' => 'required|string',
        ]);

        // Find the bookmark
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('online_book_id', $request->online_book_id)
            ->firstOrFail();

        // Delete the bookmark
        $bookmark->delete();

        // Redirect to the specified URL
        return redirect($request->redirect_url)->with('success', 'Bookmark removed successfully!');
    }
}
