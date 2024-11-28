<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Product $product)
    {
        $product->load('productImages');

        // Kiểm tra xem người dùng đã mua sản phẩm hay chưa
        $userId = 1; // hardcode user id
        $hasPurchased = Order::where('user_id', $userId)
            ->where('status', 'paid')
            ->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        // Lấy các đánh giá cho sản phẩm
        $ratings = Rating::where('product_id', $product->id)->get();

        return view('products.show', [
            'product' => $product,
            'hasPurchased' => $hasPurchased,
            'ratings' => $ratings,
        ]);
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
