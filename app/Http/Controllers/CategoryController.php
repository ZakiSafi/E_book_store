<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $id)
    {
        $categories = Category::all();
        $category = Category::with(' onlineBooks')->find($id);
        return view('categories.show', compact('category', 'categories'));
    }
}
