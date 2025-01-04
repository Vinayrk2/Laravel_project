<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Categories;

class ProductController extends Controller
{
    public function categorizedProducts($name, Request $request)
    {
        // Get all unique filters for the filter sidebar
        $filters = [
            'manufacturers' => Product::select('manufacturer')->distinct()->get(),
            'categories' => Categories::all(),
            'conditions' => Product::select('condition')->distinct()->get(),
            'availabilities' => Product::select('availability')->distinct()->get(),
        ];

        // Query builder for products
        $query = Product::query();

        // Handle category filtering
        $selectedCategories = [];
        
        // If category filters are applied via checkboxes
        if ($request->has('category')) {
            $selectedCategories = (array)$request->category;
            $query->whereIn('category_id', $selectedCategories);
        }
        // If no category filter is applied but URL category is not 'all'
        elseif ($name !== 'all') {
            $category = Categories::where('name', $name)->first();
            if ($category) {
                $selectedCategories[] = $category->id;
                $query->where('category_id', $category->id);
            }
        }

        // Apply manufacturer filter
        if ($request->has('manufacturer')) {
            $manufacturers = (array)$request->manufacturer;
            $query->whereIn('manufacturer', $manufacturers);
        }

        // Apply condition filter
        if ($request->has('condition')) {
            $conditions = (array)$request->condition;
            $query->whereIn('condition', $conditions);
        }

        // Apply availability filter
        if ($request->has('availability')) {
            $availabilities = (array)$request->availability;
            $query->whereIn('availability', $availabilities);
        }

        // Get paginated results with relationships
        $products = $query->with('category')->paginate(15)->withQueryString();

        return view('product.category', compact('products', 'filters', 'name', 'selectedCategories'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);
        
        // Get related products from same category
        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related_products'));
    }
}