<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OnlineBookController extends Controller
{


    public function index()
    {

        $books = OnlineBook::where('status', OnlineBook::STATUS_APPROVED)
            ->latest()
            ->simplePaginate(24);
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }


    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'language' => 'required',
            'description' => 'nullable',
            'cover_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'book_file' => 'required|mimes:pdf|max:100000',
            'release_date' => 'required|date',
            'edition' => 'nullable',

        ]);
        if (Auth::check() && Auth::user()->role == 'admin') {
            $attributes['status'] = OnlineBook::STATUS_APPROVED;
        } else {
            $attributes['status'] = OnlineBook::STATUS_PENDING;
        }

        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }


        if ($request->hasFile('book_file')) {
            $bookFile = $request->file('book_file');


            $attributes['file_path'] = $bookFile->store('books', 'public');


            $attributes['file_type'] = $bookFile->getMimeType();
            $attributes['file_size'] = $bookFile->getSize();
        }

        /** @var User $user */
        $attributes['user_id'] = Auth::user()->id;


        $attributes['downloads'] = 0;


        OnlineBook::create($attributes);


        if (Auth::user()->role == 'admin') {
            return redirect()->route('books.index')->with('success', 'Book successfully added.');
        } else {
            return redirect()->route('books.index')->with('success', 'Your contributed book has been recieved and pending approval by admin');
        }
    }


    public function show(OnlineBook $book)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('online_book_id', $book->id)
            ->first();

        $isBookmarked = $bookmark ? true : false;


        $relatedBooks = OnlineBook::with('category')
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->orWhere(function ($query) use ($book) {
                $query->where('title', 'like', '%' . $book->title . '%')
                    ->where('id', '!=', $book->id);
            })
            ->get();
        return view('books.show', compact('book', 'relatedBooks', 'isBookmarked', 'bookmark'));
    }



    public function edit(OnlineBook $book)
    {
        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }



    public function update(Request $request, OnlineBook $book)
    {
        $attributes = $request->validate([
            'title' => 'required|string',
            'author' => 'required |string',
            'category_id' => 'required',
        ]);
        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('cover_images');
        } else {

            $attributes['cover_image'] = $request->input('old_cover_image');
        }
        $book->update($attributes);
        $user = Auth::user();
        if ($user->role === 'user') {

            return redirect()->route('books.index')->with('success', 'Book updated successfully');
        } else {

            return redirect()->route('admin.books.index')->with('success', 'book updated successfully');
        }
    }




    public function destroy(OnlineBook $book)
    {
        $user = Auth::user();
        $this->authorize('delete', $book);
        $book->delete();
        if ($user->role === 'user') {

            return redirect()->route('user.books')->with('success', 'Book deleted successfully');
        } else {
            return redirect()->route('admin.books.index')->with('success', 'book deleted successfully');
        }
    }
}
