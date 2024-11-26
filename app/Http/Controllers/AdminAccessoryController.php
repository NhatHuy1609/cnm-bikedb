<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminAccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories = Product::whereHas('category', function ($query) {
            $query->where('id', 4)
                ->orWhere('parent_category_id', 4);
        })
        ->with(['category', 'productImages', 'discount'])
        ->select(['id', 'name', 'price', 'quantity', 'category_id', 'updated_at'])
        ->latest()
        ->paginate(10);

        return view('admin.accessories.index', compact('accessories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
