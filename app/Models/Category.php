<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_category_id'
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }
}
