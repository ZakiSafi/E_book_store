<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\PhysicalBook;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $categories = Category::all();
        $title = $request->input('title');

        // Query Online Books
        $onlineBooksQuery = OnlineBook::where('status', OnlineBook::STATUS_APPROVED)
            ->where('title', 'like', "%$title%");

        // Query Physical Books
        $physicalBooksQuery = PhysicalBook::where('title', 'like', "%$title%");

        // If no title is entered, return just the categories
        if (!$request->filled('title')) {
            $onlineBooks = null;
            $physicalBooks = null;
            return view('books.search', compact('categories', 'onlineBooks', 'physicalBooks'));
        }

        // Apply Category filter
        if ($request->filled('category') && $request->input('category') !== 'Select Category') {
            $category = $request->input('category');

            $onlineBooksQuery->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });

            $physicalBooksQuery->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // Apply Language filter
        if ($request->filled('language') && $request->input('language') !== 'All Languages') {
            $language = $request->input('language');

            $onlineBooksQuery->where('language', 'like', "%$language%");
            $physicalBooksQuery->where('language', 'like', "%$language%");
        }

        // Fetch Results
        $onlineBooks = $onlineBooksQuery->get();
        $physicalBooks = $physicalBooksQuery->get();

        return view('books.search', compact('onlineBooks', 'physicalBooks', 'title', 'categories'));
    }
}
