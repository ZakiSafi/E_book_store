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
        $this->middleware('auth')->except(['index', 'show']);  // Only `index` is accessible by anyone
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->simplePaginate(16);
        $categories = Category::all();
        // $totaldownloads = Book::sum('downloads');
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $attributes = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'language' => 'required',
            'description' => 'nullable',
            'cover_image' => 'nullable|image|max:2048', // Cover image optional
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'book_file' => 'required|mimes:pdf|max:100000', // Validate book file (PDF, max size 2MB)
            'release_date' => 'required|date',
            'edition' => 'nullable',

        ]);

        // Handle the cover image upload (if provided)
        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        // Handle the book file upload
        if ($request->hasFile('book_file')) {
            $bookFile = $request->file('book_file');

            // Store the file and retrieve the path
            $attributes['file_path'] = $bookFile->store('books', 'public');

            // Extract file type and size
            $attributes['file_type'] = $bookFile->getMimeType();
            $attributes['file_size'] = $bookFile->getSize();
        }

        // Add the user ID (assuming the user is authenticated)
        /** @var User $user */
        $attributes['user_id'] = Auth::user()->id;

        // Set the default downloads to 0 (optional since default is set in the migration)
        $attributes['downloads'] = 0;

        // Create the book record in the database
        Book::create($attributes);

        // Redirect or respond with success
        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    /*
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first(); // Use first() to get the first record or null

        $isBookmarked = $bookmark ? true : false; // Determine if the book is bookmarked

        $relatedBooks = $book->relatedBooks()->get();

        return view('books.show', compact('book', 'relatedBooks', 'isBookmarked', 'bookmark'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
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
            // Use the old cover image if no new image was uploaded
            $attributes['cover_image'] = $request->input('old_cover_image');
        }
        $book->update($attributes);
        return redirect('/books')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect('/bookmarks')->with('success', 'Book deleted successfully');
    }

    public function search(Request $request)
    {
        // Start a query on the Book model
        $query = Book::query();
        $categories = Category::all();

        // Add search conditions dynamically
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%')
                ->orderByRaw(
                    "CASE
                WHEN title = ? THEN 1
                ELSE 2
            END ASC",
                    [$request->input('title')]
                )
                ->orderByRaw("LENGTH(title) - LENGTH(REPLACE(title, ?, '')) DESC", [$request->input('title')]);
        }


        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('category') . '%')
                    ->orderByRaw(
                        "CASE
                WHEN name = ? THEN 1
                ELSE 2
            END ASC",
                        [$request->input('category')]
                    )
                    ->orderByRaw("LENGTH(name) - LENGTH(REPLACE(name, ?, '')) DESC", [$request->input('category')]);
            });
        }

        if ($request->filled('language')) {
            $query->where('language', 'like', '%' . $request->input('language') . '%');
        }

        // Execute the query and retrieve results
        $searchQuery = $request->input('title');
        $books = $query->get();

        // Return results to the appropriate view
        return view('books.search', compact('books', 'searchQuery', 'categories'));
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);

        $book->increment('downloads');

        $filePath = $book->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            return response()->download(storage_path('app/public/' . $filePath));
        }

        return redirect()->route('books.index')->with('error', 'File not found.');
    }

    public function read($id)
    {
        $books = Book::where('id', '!=', $id) // Exclude the current book
            ->take(16) // Fetch only 6 books
            ->get();;
        $book = Book::findOrFail($id);

        return view('books.read',compact('book','books'));
    }
    public function readPdf($id)
    {
        $book = Book::findOrFail($id);

        // Ensure file_path exists
        if (!$book->file_path) {
            abort(404, 'File not found.');
        }

        // Check if the file exists in the storage
        if (!Storage::disk('public')->exists($book->file_path)) {
            abort(403, 'Forbidden: File not accessible.');
        }

        // Serve the PDF file
        return response()->file(storage_path('app/public/' . $book->file_path));
    }


}
