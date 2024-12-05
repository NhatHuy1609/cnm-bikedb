<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBikeController extends Controller
{
    protected $cloudinary;

    public function __construct(Cloudinary $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::where('parent_category_id', 1)
            ->get();
        $bikes = Product::query()
            ->whereHas('category', function ($query) {
                $query->where('id', 1)
                    ->orWhere('parent_category_id', 1);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('brand'), function ($query) use ($request) {
                $query->where('brand_id', $request->brand);
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->filled('min_price'), function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })
            ->when($request->filled('max_price'), function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })
            ->when($request->filled('out_of_stock'), function ($query) use ($request) {
                $query->where('quantity', 0);
            })
            ->when($request->filled('low_stock'), function ($query) use ($request) {
                $query->where('quantity', '<=', 5);
            })
            ->when($request->filled('in_stock'), function ($query) use ($request) {
                $query->where('quantity', '>', 0);
            })
            ->with(['category', 'productImages', 'brand', 'discount'])
            ->select(['id', 'name', 'price', 'quantity', 'category_id', 'brand_id', 'updated_at'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.bikes.index', compact('bikes', 'brands', 'categories'));
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

        DB::beginTransaction();
        try {
            // Create the product
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity ?? 0,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
            ]);

            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $result = $this->cloudinary->uploadApi()->upload(
                            $file->getRealPath(),
                            [
                                'folder' => 'cmn-bike-store',
                                'resource_type' => 'image'
                            ]
                        );

                        ProductImage::create([
                            'product_id' => $product->id,
                            'link' => $result['secure_url'],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.bikes.index')
                ->with('success', 'Bike created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create bike: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create bike: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $bike = Product::with(['productImages', 'category', 'brand', 'discount'])
            ->findOrFail($id);
        
        return view('admin.bikes.show', compact('bike'));
    }

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

        DB::beginTransaction();
        try {
            // Update basic bike information
            $bike = Product::findOrFail($id);
            $bike->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity ?? 0,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
            ]);

            // Handle deleted images
            if ($request->filled('deleted_images')) {
                $deletedImageIds = explode(',', $request->deleted_images);
                $imagesToDelete = ProductImage::where('product_id', $bike->id)
                    ->whereIn('id', $deletedImageIds)
                    ->get();

                foreach ($imagesToDelete as $image) {
                    // Delete from Cloudinary
                    $publicId = $this->getPublicIdFromUrl($image->link);
                    if ($publicId) {
                        try {
                            $this->cloudinary->uploadApi()->destroy($publicId);
                        } catch (\Exception $e) {
                            Log::warning("Failed to delete image from Cloudinary: {$e->getMessage()}");
                        }
                    }
                }

                // Delete from database
                ProductImage::whereIn('id', $deletedImageIds)
                    ->where('product_id', $bike->id)
                    ->delete();
            }

            // Handle new images
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $result = $this->cloudinary->uploadApi()->upload(
                            $file->getRealPath(),
                            [
                                'folder' => 'cmn-bike-store',
                                'resource_type' => 'image'
                            ]
                        );

                        ProductImage::create([
                            'product_id' => $bike->id,
                            'link' => $result['secure_url'],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.bikes.index')->with('success', 'Bike updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update bike: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update bike: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $bike = Product::findOrFail($id);
            
            $bike->delete();
            
            DB::commit();
            return redirect()->route('admin.bikes.index')
                ->with('success', 'Bike deleted successfully');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete bike: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->route('admin.bikes.index')
                ->with('error', 'Failed to delete bike: ' . $e->getMessage());
        }
    }

    private function getPublicIdFromUrl($url)
    {
        // Extract the public ID from Cloudinary URL
        // Example URL: https://res.cloudinary.com/your-cloud-name/image/upload/v1234567890/cmn-bike-store/abcdef123456.jpg
        if (preg_match('/cmn-bike-store\/([^.]+)/', $url, $matches)) {
            return 'cmn-bike-store/' . $matches[1];
        }
        return null;
    }

    public function trash(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::where('parent_category_id', 1)->get();
        
        $bikes = Product::onlyTrashed()
            ->whereHas('category', function ($query) {
                $query->where('id', 1)
                    ->orWhere('parent_category_id', 1);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('brand'), function ($query) use ($request) {
                $query->where('brand_id', $request->brand);
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->filled('min_price'), function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })
            ->when($request->filled('max_price'), function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })
            ->when($request->filled('out_of_stock'), function ($query) use ($request) {
                $query->where('quantity', 0);
            })
            ->when($request->filled('low_stock'), function ($query) use ($request) {
                $query->where('quantity', '<=', 5);
            })
            ->when($request->filled('in_stock'), function ($query) use ($request) {
                $query->where('quantity', '>', 0);
            })
            ->when($request->filled('sort'), function ($query) use ($request) {
                switch ($request->sort) {
                    case 'price_asc':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'newest':
                        $query->latest('deleted_at');
                        break;
                    case 'oldest':
                        $query->oldest('deleted_at');
                        break;
                    default:
                        $query->latest('deleted_at');
                }
            }, function ($query) {
                $query->latest('deleted_at'); // Default sorting
            })
            ->with(['category', 'productImages', 'brand', 'discount'])
            ->select(['id', 'name', 'price', 'quantity', 'category_id', 'brand_id', 'updated_at', 'deleted_at'])
            ->paginate(10)
            ->withQueryString();

        return view('admin.bikes.trash', compact('bikes', 'brands', 'categories'));
    }

    public function restore(string $id)
    {
        $bike = Product::onlyTrashed()->findOrFail($id);
        $bike->restore();
        return redirect()->route('admin.bikes.trash')->with('success', 'Bike restored successfully');
    }

    public function forceDelete(string $id)
    {
        $bike = Product::onlyTrashed()->findOrFail($id);
        $bike->forceDelete();
        return redirect()->route('admin.bikes.trash')->with('success', 'Bike deleted permanently');
    }
}
