<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = OnlineBook::where('status', OnlineBook::STATUS_APPROVED);
        $categories = Category::all();

        // Check if there are no filters (i.e., request is empty)
        if (!$request->filled('title')) {
            // Return null or an empty collection
            return view('books.search', compact('categories'))->with('books', null);
        }

        // Filter by Title
        if ($request->filled('title')) {
            $title = $request->input('title');
            $query->where('title', 'like', "%$title%");
        }

        // Filter by Category only if it's NOT "All Categories"
        if ($request->filled('category') && $request->input('category') !== 'Select Category') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->input('category'));
            });
        }

        // Filter by Language
        if ($request->filled('language') && $request->input('language') !== 'All Languages') {
            $query->where('language', 'like', '%' . $request->input('language') . '%');
        }

        // Get results
        $books = $query->get();

        // Return results (null if no books found)
        return view('books.search', compact('books', 'categories'));
    }
}
