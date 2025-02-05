<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function users(){
        $users = User::with('books')->where('role', '!=','admin')->latest()->simplePaginate(30);
        $totalUsers = User::count();
        return view('admin.users',compact('users', 'totalUsers'));
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users');
    }
    public function books($id){
        $books = Book::where('user_id',$id)->get();
        return view('admin.user_books',compact('books'));
    }
}
