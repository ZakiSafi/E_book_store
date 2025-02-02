<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function books(){
        return view("admin.books");
    }
    public function users(){
        return view('admin.users');

    }
}
