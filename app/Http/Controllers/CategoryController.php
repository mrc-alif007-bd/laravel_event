<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::all();
        return view('backend.category.category_list', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100', // Changed from c_name to name, max 100 to match migration
            'description' => 'nullable|max:200', // Changed to nullable and max 200 to match migration
        ]);

        Category::create([
            'name' => $request->name, // Changed from c_name to name
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('backend.category.category_show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3|max:100', // Changed from c_name to name, max 100 to match migration
            'description' => 'nullable|max:200', // Changed to nullable and max 200 to match migration
        ]);

        $category->update([
            'name' => $request->name, // Changed from c_name to name
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully');
    }
}
