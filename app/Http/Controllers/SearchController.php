<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\Categories;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // Get filters
        $filters = [
            'manufacturers' => Product::select('manufacturer')->distinct()->get(),
            'categories' => Categories::all(),
            'conditions' => Product::select('condition')->distinct()->get(),
            'availabilities' => Product::select('availability')->distinct()->get(),
        ];

        // Start with base query
        $productsQuery = Product::query();

        // Search terms
        $productsQuery->where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->orWhere('part_number', 'LIKE', "%{$query}%");
        });

        // Apply filters if present
        if ($request->filled('manufacturer')) {
            $productsQuery->whereIn('manufacturer', (array)$request->manufacturer);
        }

        if ($request->filled('category')) {
            $productsQuery->whereIn('category_id', (array)$request->category);
        }

        if ($request->filled('condition')) {
            $productsQuery->whereIn('condition', (array)$request->condition);
        }

        if ($request->filled('availability')) {
            $productsQuery->whereIn('availability', (array)$request->availability);
        }

        // Get paginated products
        $products = $productsQuery->with('category')->paginate(15);
        $productsCount = $productsQuery->count();

        // Search news
        $news = News::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->latest()
            ->take(5)
            ->get();

        return view('search.results', compact(
            'products', 
            'news', 
            'query', 
            'filters',
            'productsCount'
        ));
    }
} 