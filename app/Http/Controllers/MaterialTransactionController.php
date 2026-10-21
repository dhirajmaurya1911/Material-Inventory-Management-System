<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialTransaction;
use Illuminate\Http\Request;

class MaterialTransactionController extends Controller
{
    /**
     * Show inward/outward form.
     */
    public function create()
    {
        //view page
        $categories = Category::with('materials')
            ->orderBy('name')
            ->get();

        return view(
            'transactions.create',
            compact('categories')
        );
    }

    /**
     * Save inward/outward transaction.
     */
    public function store(Request $request)
    {
        //when you click add then call this function
        $validated = $request->validate([
            'material_id' => [
                'required',
                'exists:materials,id',
            ],

            'transaction_date' => [
                'required',
                'date',
            ],

            'quantity' => [
                'required',
                'numeric',
                'regex:/^-?\d+(\.\d{1,2})?$/',
            ],
        ]);

        MaterialTransaction::create($validated);

        return redirect()
            ->route('transactions.create')
            ->with(
                'success',
                'Material quantity updated successfully.'
            );
    }
}