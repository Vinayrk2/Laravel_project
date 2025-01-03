<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all categories to randomly associate products with them
        $categories = DB::table('categories')->pluck('id')->toArray();

        // Generate 10 dummy products
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . Str::random(5),
                'part_number' => 'PN' . strtoupper(Str::random(8)),
                'description' => 'This is a dummy description for Product ' . $i,
                'price' => mt_rand(1000, 10000) / 100, // Random price between 10.00 and 100.00
                'category_id' => $categories ? $categories[array_rand($categories)] : null,
                'features' => json_encode([
                    'feature1' => 'Feature description 1',
                    'feature2' => 'Feature description 2',
                    'feature3' => 'Feature description 3',
                ]),
                'more_details' => 'Additional details about Product ' . $i,
                'manufacturer' => 'Manufacturer ' . chr(65 + $i),
                'condition' => ['New', 'Used', 'Refurbished'][array_rand(['New', 'Used', 'Refurbished'])],
                'availability' => ['In Stock', 'Out of Stock', 'Limited Availability'][array_rand(['In Stock', 'Out of Stock', 'Limited Availability'])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
