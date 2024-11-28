<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
        $brands = Brand::all();
        
        $subCategories = Category::where('parent_category_id', 1)
            ->get()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'has_children' => $category->subCategories()->exists()
                ];
            });

        return view('admin.bikes.create', compact('brands', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        // Create the product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('admin.bikes.index')->with('success', 'Bike created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bike = Product::with(['productImages', 'category', 'brand', 'discount'])
            ->findOrFail($id);
        
        return view('admin.bikes.show', compact('bike'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bike = Product::with('productImages', 'category')->findOrFail($id);
        $brands = Brand::all();
        
        // Get bike categories (Level 1)
        $subCategories = Category::where('parent_category_id', 1)
            ->get()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name
                ];
            });

        return view('admin.bikes.edit', compact('bike', 'brands', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        // Update
        $bike = Product::findOrFail($id);
        $bike->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('admin.bikes.index')->with('success', 'Bike updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
