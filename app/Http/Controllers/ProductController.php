<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    

    public function categorizedProducts(Request $request, $name)
    {
        Log::info('Fetching products for category:', ['category_name' => $name]);
    
        if ($name != "all" && $request->query('category')) {
            $data = $request->query();
            $query = http_build_query($data);
            Log::info('Redirecting to all products with query:', ['query' => $query]);
            return redirect()->route('product.category.all', ['query' => $query]);
        } else {
            Log::info('Fetching category by name:', ['category_name' => $name]);
            $category = Categories::where('name', $name)->first();
    
            if ($category) {
                Log::info('Category found:', ['category' => $category]);
                // Use the query builder to paginate directly
                $products = $category->products()->paginate(15); // Adjust the number of items per page as needed
                Log::info('Products fetched for category:', ['products' => $products->toArray()]);
            } 
            else if($name=='all'){
                Log::info('Fetching all products');
                $products = Product::paginate(15); // Adjust the number of items per page as needed
            }
            else {
                Log::info('Category not found:', ['category_name' => $name]);
                $products = collect(); // Initialize as an empty collection
            }
        }
    
        if ($products->isEmpty()) {
            Log::info('No products found for category:', ['category_name' => $name]);
            $pageObj = null;
            $filter = $this->getFilterOptions();
            return view('product.category', [
                'products' => $pageObj,
                'filters' => $filter,
                'name' => $name,
            ]);
        }
    
        // No need to create a products dictionary since we are paginating directly
        $count = [
            'products' => $products->total(), // Get the total count of products
        ];
    
        Log::info('Pagination and count:', ['page_obj' => $products, 'count' => $count]);
    
        $filter = $this->getFilterOptions();
        return view('product.category', [
            'products' => $products, // Pass the paginated products directly
            'name' => $name,
            'count' => $count,
            'filters' => $filter,
        ]);
    }

    public function getFilterOptions()
{
    // Get the distinct values for each filter option
    $categories = Categories::all();
    $manufacturers = Product::distinct()->select('manufacturer')->get();
    $conditions = Product::distinct()->select('condition')->get();
    $availabilities = Product::distinct()->select('availability')->get();

    return [
        'categories' => $categories,
        'manufacturers' => $manufacturers,
        'conditions' => $conditions,
        'availabilities' => $availabilities
    ];
}
}