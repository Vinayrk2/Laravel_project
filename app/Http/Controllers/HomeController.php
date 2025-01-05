<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // Fetch the first 4 categories
        $categories = Categories::take(10)->get();

        // Fetch the latest 5 products
        $products = Product::orderBy('created_at', 'desc')->take(5)->get();

        // Fetch the HomeSection instance
        $homeSection = HomeSection::find(1);

        $whatWeDo = [];
        $images = [];

        if ($homeSection) {
            $images = $homeSection->images; // Related carousel images
            $whatWeDo = $homeSection->items; // Related items
        }

        // Format products as a dictionary (array)
        $productsDict = $products->map(function ($product) use ($request) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->adjusted_price,
                'image' => $product->image, // Assume getImageUrl() returns the image URL
                'currency' => session('currency', "CAD"),
                'category'=> $product->category,
                // Add other fields as needed
            ];
        });

        // Pass data to the Blade view
        return view('home', [
            'categories' => $categories,
            'products' => $productsDict,
            'whatWeDo' => $whatWeDo,
            'images' => $images,
        ]);
    }
}
