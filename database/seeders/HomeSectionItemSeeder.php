<?php

// database/seeders/HomeSectionItemSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSectionItemSeeder extends Seeder
{
    public function run()
    {
        $homeSectionItems = [
            [
                'home_id' => 1,
                'title' => 'Section 1 Item 1',
                'description' => 'Description for Section 1 Item 1',
                'image' => 'image1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'home_id' => 1,
                'title' => 'Section 1 Item 2',
                'description' => 'Description for Section 1 Item 2',
                'image' => 'image2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'home_id' => 1,
                'title' => 'Section 2 Item 1',
                'description' => 'Description for Section 2 Item 1',
                'image' => 'image3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('home_section_items')->insert($homeSectionItems);
    }
}
