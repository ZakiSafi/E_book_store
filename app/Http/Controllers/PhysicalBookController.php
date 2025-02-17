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
        //
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
