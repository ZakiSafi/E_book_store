<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use App\Models\OnlineBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function users()
    {
        $searchType = 'Users';
        $users = User::with('Onlinebooks')->where('role', '!=', 'admin')->latest()->simplePaginate(30);
        $totalUsers = User::count();
        return view('admin.users', compact('users', 'totalUsers', 'searchType'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
    public function books($id)
    {
        $books = OnlineBook::where('user_id', $id)->get();
        $borrowedBooks = BorrowedBook::where('user_id', $id)->get();
        return view('admin.user_books', compact('books', 'borrowedBooks'));
    }
}
