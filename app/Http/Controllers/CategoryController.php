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
            'c_name' => 'required|min:3|max:50',
            'description' => 'required',
        ]);



        Category::create([
            'name'        => $request->c_name,
            'description' => $request->description,

        ]);

        return redirect()->route('category.index')->with('success', 'Category added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
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
            'c_name' => 'required|min:3|max:50',
            'description' => 'required',
        ]);



        $category->update([
            'name'        => $request->c_name,
            'description' => $request->description,

        ]);

        return redirect()->route('category.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

    $category->delete();

    return redirect()->route('category.index')
        ->with('success', 'Successfully Deleted');
    }
}
