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
        $request->validate(['online_book_id' | 'exists:books,id']);
        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'online_book_id' => $request->book_id,
        ]);
        return back()->with('success', 'Successfully added to Bookmarks');
    }
    public function destroy($id, Request $request)
    {
        $boomark = Bookmark::findOrFail($id);
        if ($boomark->user_id != Auth::id()) {
            abort(403, 'unautherized action');
        }
        $boomark->delete();
        $redirectUrl = $request->input('redirect_url');
        return redirect($redirectUrl)->with('success', 'Bookmark removed successfully!');
    }
}
