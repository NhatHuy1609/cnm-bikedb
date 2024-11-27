<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminBikeController extends Controller
{
    public function index()
    {
        $bikes = Product::whereHas('category', function ($query) {
            $query->where('id', 1)
                ->orWhere('parent_category_id', 1);
        })
        ->with(['category', 'productImages', 'brand', 'discount'])
        ->select(['id', 'name', 'price', 'quantity', 'category_id', 'brand_id', 'updated_at'])
        ->latest()
        ->paginate(10);

        return view('admin.bikes.index', compact('bikes'));
    }

    public function create()
    {
        return view('admin.bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
