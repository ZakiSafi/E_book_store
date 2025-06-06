<?php

namespace App\Http\Controllers;

use App\Models\OnlineBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookDownloadController extends Controller
{
    public function download($id)
    {
        $book = OnlineBook::findOrFail($id);

        $book->increment('downloads');

        $filePath = $book->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            return response()->download(storage_path('app/public/' . $filePath));
        }

        return redirect()->route('books.index')->with('error', 'File not found.');
    }

    public function read($id)
    {
        $books = OnlineBook::where('id', '!=', $id)
            ->take(16)
            ->get();;
        $book = OnlineBook::findOrFail($id);

        return view('books.read', compact('book', 'books'));
    }
    public function readPdf($id)
    {
        $book = OnlineBook::findOrFail($id);
        if (!$book->file_path) {
            abort(404, 'File not found.');
        }

        if (!Storage::disk('public')->exists($book->file_path)) {
            abort(403, 'Forbidden: File not accessible.');
        }

        return response()->file(storage_path('app/public/' . $book->file_path));
    }
}
