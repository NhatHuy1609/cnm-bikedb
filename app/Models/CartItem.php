<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    protected $primaryKey = 'cart_id';

    public $incrementing = false;

    protected function setKeysForSaveQuery($query)
    {
        $query->where('cart_id', $this->cart_id);
        return $query->where('product_id', $this->product_id);
    }

    protected function setKeysForDeleteQuery($query)
    {
        $query->where('cart_id', $this->cart_id);
        return $query->where('product_id', $this->product_id);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}