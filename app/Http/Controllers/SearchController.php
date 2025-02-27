<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use App\Models\User;
use App\Models\Category;
use App\Models\OnlineBook;
use App\Models\PhysicalBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $categories = Category::all();
        $title = $request->input('title');

        $onlineBooksQuery = OnlineBook::where('status', OnlineBook::STATUS_APPROVED)
            ->where('title', 'like', "%$title%");

        $physicalBooksQuery = PhysicalBook::where('title', 'like', "%$title%");

        if (!$request->filled('title')) {
            $onlineBooks = null;
            $physicalBooks = null;
            return view('books.search', compact('categories', 'onlineBooks', 'physicalBooks'));
        }

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

    public function adminSearch(Request $request)
    {
        $query = $request->input('query');
        $searchType = $request->input('search_type');
        $results = [];

        switch ($searchType) {
            case 'Users':
                $results = User::where('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->get();
                break;

            case 'Online Books':
                $results = OnlineBook::where('title', 'like', "%$query%")
                    ->orWhere('author', 'like', "%$query%")
                    ->get();
                break;

            case 'Physical Books':
                $results = PhysicalBook::where('title', 'like', "%$query%")
                    ->orWhere('author', 'like', "%$query%")
                    ->get();
                break;

            case 'Borrowed Books':
                $results = BorrowedBook::whereHas('book', function ($q) use ($query) {
                    $q->where('title', 'like', "%$query%")
                        ->whereNull('returned_at');
                })
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%$query%")
                            ->whereNull('returned_at');
                    })
                    ->get();
                break;

            case 'Borrowed Books History':

                $results = BorrowedBook::whereHas('book', function ($q) use ($query) {
                    $q->where('title', 'like', "%$query%")
                        ->where('returned_at', '>=', now()->subMonth());
                })
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%$query%")
                            ->where('returned_at', '>=', now()->subMonth());
                    })
                    ->get();
                break;


            default:
                $results = collect();
                break;
        }
        return view('admin.searchResult', compact('results', 'query', 'searchType'));
    }
}
