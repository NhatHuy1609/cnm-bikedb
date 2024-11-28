<?php

namespace App\Services;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;

class GeneralCategoryService
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoryById($id)
    {
        return $this->category->find($id);
    }

    public function getAllHighestLevelCategories()
    {
        return $this->category->where('parent_category_id', null)->get();
    }
}
