<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $books = Book::latest()->simplePaginate(16);
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


        Book::create($attributes);


        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }


    public function show(Book $book)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        $isBookmarked = $bookmark ? true : false;

        $relatedBooks = $book->relatedBooks()->get();

        return view('books.show', compact('book', 'relatedBooks', 'isBookmarked', 'bookmark'));
    }



    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }



    public function update(Request $request, Book $book)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
        ]);
        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('cover_images');
        } else {

            $attributes['cover_image'] = $request->input('old_cover_image');
        }
        $book->update($attributes);
        return redirect('/books')->with('success', 'Book updated successfully');
    }




    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect('/bookmarks')->with('success', 'Book deleted successfully');
    }

    
}
