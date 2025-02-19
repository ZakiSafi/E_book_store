<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;

class PhysicalBookController extends Controller
{
    public function index()
    {
        $totalBooks = PhysicalBook::all()->count();
        $physicalBooks = PhysicalBook::latest()->simplePaginate(24);
        $books = $physicalBooks->map(function ($book) {
            $book->type = 'physical book';
            return $book;
        });
        $categories = Category::all();
        return view('physical_books.index', compact('books', 'totalBooks', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('physical_books.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'author' => 'required|string',
            'translator' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jfif,jpeg,png,jpg,gif|max:3072',
            'publication_year' => 'required|integer',
            'printing_house' => 'required|string',
            'edition' => 'nullable|string',
            'shelf_no' => 'required|integer',
            'copies' => 'required|integer',
            'language' => 'required|string',
            'category_id' => 'required|integer',
        ]);
        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('physical_books', 'public');
        }

        PhysicalBook::create($attributes);
        return redirect()->route('physicalBooks.index');
    }


    public function show(string $id)
    {
        $book = PhysicalBook::find($id);
        $relatedBooks = PhysicalBook::with('category')->where([['category_id', $book->category_id], ['id', '!=', $book->id]])->get();
        return view('physical_books.show', compact('book', 'relatedBooks'));
    }


    public function edit(string $id)
    {
        $book = PhysicalBook::find($id);
        $categories = Category::all();
        return view('physical_books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, PhysicalBook $book)
    {
        $attributes = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'author' => 'required|string',
            'translator' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jfif,jpeg,png,jpg,gif|max:3072',
            'publication_year' => 'required|integer',
            'printing_house' => 'required|string',
            'edition' => 'nullable|string',
            'shelf_no' => 'required|integer',
            'copies' => 'required|integer',
            'language' => 'required|string',
            'category_id' => 'required|integer',
        ]);
        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('cover_image', 'public');
        } else {
            $attributes['cover_image'] = $request->input('old_cover_image');
        }

        $book->update($attributes);


        return redirect()->route('physicalBooks.index');
    }


    public function destroy(PhysicalBook $book)
    {
        $book->delete();
        return redirect()->route('admin.dashboard');
    }
}
