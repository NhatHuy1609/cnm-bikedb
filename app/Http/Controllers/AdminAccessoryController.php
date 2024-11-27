<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
                ->orWhere('parent_category_id', 4)
                ->orWhereIn('id', function($subquery) {
                    $subquery->select('id')
                        ->from('categories')
                        ->whereIn('parent_category_id', function($q) {
                            $q->select('id')
                                ->from('categories')
                                ->where('parent_category_id', 4);
                        });
                });
        })
        ->with(['category', 'productImages', 'brand', 'discount'])
        ->select(['id', 'name', 'price', 'quantity', 'category_id', 'brand_id', 'updated_at'])
        ->latest()
        ->paginate(10);

        return view('admin.accessories.index', compact('accessories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        
        $subCategories = Category::where('parent_category_id', 4)
            ->get()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'has_children' => $category->subCategories()->exists()
                ];
            });

        return view('admin.accessories.create', compact('brands', 'subCategories'));
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

        return redirect()->route('admin.accessories.index')->with('success', 'Accessory created successfully');
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
