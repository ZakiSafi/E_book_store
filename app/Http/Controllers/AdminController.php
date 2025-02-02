<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.dashboard',compact('user'));
    }
    public function books(){
        return view("admin.books");
    }
    public function users(){
        return view('admin.users');

    }
}
