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
        $physicalBooks = PhysicalBook::all();
        $books = $physicalBooks->map(function ($book) {
            $book->type = 'physical book';
            return $book;
        });
        $categories = Category::all();
        return view('physical_books.index', compact('books', 'totalBooks', 'categories'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        $book = PhysicalBook::find($id);
        $relatedBooks = PhysicalBook::with('category')->where([['category_id', $book->category_id], ['id', '!=', $book->id]])->get();
        return view('physical_books.show', compact('book', 'relatedBooks'));
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
