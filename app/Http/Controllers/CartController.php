<?php

namespace App\Http\Controllers;


use App\Http\Requests\Api\CartCreateRequest;
use App\Http\Requests\Api\CartUpdateRequest;
use App\Http\Requests\Api\CartDeleteRequest;
use App\Models\User;
use App\Services\CartService;
use App\Services\UserService;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $userService;

    protected $cartService;

    public function __construct(UserService $userService, CartService $cartService)
    {
        $this->userService = $userService;
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with(['cartItems.product'])->where('user_id', 1)->first();

        return view('cart.index', compact('cart'));
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
    public function store(CartCreateRequest $request)
    {
        $params = $request->validated();
        $data = $this->cartService->store($params);
        if($data)
        {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully.',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product addition to cart failed.'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = $this->userService->getUserCart($user->id);
        return view('carts.show',['cart' => $data]);
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
    public function update(CartUpdateRequest $request)
    {

        $params = $request->validated();
        $data = $this->cartService->updateQuantity($params);
        
        if($data)
        {
            return response()->json([
                'success' => true,
                'message' => 'Cart update successful.',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Cart update failed.'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartDeleteRequest $request)
    {
        $params = $request->validated();
        $result = $this->cartService->destroy($params);
        if ($result){
            return response()->json([
                'success' => true,
                'message' => 'Product deletion successful.',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product deletion failed.'
            ], 400);
        }
    }
}
