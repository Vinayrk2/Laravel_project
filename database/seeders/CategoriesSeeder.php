<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define some dummy category names
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Books',
            'Toys & Games',
            'Sports & Outdoors',
            'Beauty & Personal Care',
            'Automotive',
            'Health',
            'Garden & Outdoor',
        ];

        // Insert each category into the database
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'image' => 'default.png', // Default image for now
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
