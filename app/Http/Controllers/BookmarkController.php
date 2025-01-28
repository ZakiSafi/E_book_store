<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(){
        $user = Auth::user();

        $bookmarks = Bookmark::where('user_id', Auth::id())
        ->with('book')  // Eager load the related 'book' model
        ->get();

        return view('bookmarks.index', compact('bookmarks', 'user'));
    }
    public function store(Request $request)
    {
        $request->validate(['book_id' | 'exists:books,id']);
        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id, // Book ID from the request
        ]);
        return back()->with('success','Successfully added to Bookmarks');
    }
    public function destroy($id){
        $boomark = Bookmark::findOrFail($id);
        if($boomark->user_id != Auth::id()){
            abort(403, 'unautherized action');
        }
        $boomark->delete();
        return redirect('/bookmarks');

    }
}
