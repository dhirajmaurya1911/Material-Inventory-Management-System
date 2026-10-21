<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    /**
     * Display all materials with current balance.
     */
    public function index()
    {
        //Fetch data from DB
        $materials = Material::with('category')
            ->withSum('transactions', 'quantity')
            ->latest()
            ->get();

        return view('materials.index', compact('materials'));
    }

    /**
     * Show add material form.
     */
    public function create()
    {
        //view page
        $categories = Category::orderBy('name')->get();

        return view('materials.create', compact('categories'));
    }

    /**
     * Save new material.
     */
    public function store(Request $request)
    {
        //when you click add then call this function
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9 ]+$/',
            ],

            'opening_balance' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ]);

        Material::create($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material added successfully.');
    }

    /**
     * Show edit material form.
     */
    public function edit(Material $material)
    {
        //It will shoe Edit Page
        $categories = Category::orderBy('name')->get();

        return view(
            'materials.edit',
            compact('material', 'categories')
        );
    }

    /**
     * Update material basic details.
     */
    public function update(Request $request, Material $material)
    {
        //If you click on Update button then call this function
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9 ]+$/',
            ],

            'opening_balance' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ]);

        $material->update($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Soft delete material.
     */
    public function destroy(Material $material)
    {
        //Delete the records
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}