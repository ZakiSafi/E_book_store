<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function books(){
        $user = Auth::user();

        /** @var User $user */
        $books = $user->books()->get();
        return view('users.book',compact('books','user'));

    }
    public function index()
    {
        // $categories = Category::take(10)->get();
        $user = Auth::user();
        $lastUploadedBook = Book::where('user_id', $user->id)
        ->latest('created_at')
        ->first();
        $lastLoginDate = $user->last_login_at;
        return view('users.dashboard', compact('user', 'lastLoginDate', 'lastUploadedBook'));
    }

    public function show(User $user)
    {
        $user = Auth::user();
        return view('users.show',compact('user'));
    }

    public function update(Request $request)
    {

    }
   
}
