<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $id)
    {
        $categories = Category::all();
        $category = Category::with('onlineBooks', 'physicalBooks')->find($id);
        return view('categories.show', compact('category', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return redirect()->back()->with('success', 'Category '. $request->name  .' created successfully.');
    }
}
