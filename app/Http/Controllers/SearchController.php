<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $query = OnlineBook::query()
            ->where('status', OnlineBook::STATUS_APPROVED);
        $categories = Category::all();


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


        $searchQuery = $request->input('title');
        $books = $query->get();


        return view('books.search', compact('books', 'searchQuery', 'categories'));
    }
}
