<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        //Fetch data from DB
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show add category form.
     */
    public function create()
    {
        //view page
        return view('categories.create');
    }

    /**
     * Save new category.
     */
    public function store(Request $request)
    {
        //when you click add then call this function
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name',
            ],
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully.');
    }

    /**
     * Show edit category form.
     */
    public function edit(Category $category)
    {
        //It will shoe Edit Page
        return view('categories.edit', compact('category'));
    }

    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        //If you click on Update button then call this function
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Soft delete category.
     */
    public function destroy(Category $category)
    {
        //Delete the records
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}