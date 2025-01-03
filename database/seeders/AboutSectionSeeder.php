<?php

// database/seeders/AboutSectionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSectionSeeder extends Seeder
{
    public function run()
    {
        $aboutSections = [
            [
                'about_content_id' => 1, // Assuming the `about_contents` table has an entry with ID 1
                'title' => 'Our Mission',
                'description' => 'To provide top-notch services to our clients with integrity and excellence.',
                'column' => json_encode(['key1' => 'Value1', 'key2' => 'Value2']), // Example JSON data
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'about_content_id' => 1,
                'title' => 'Our Vision',
                'description' => 'To be the leading organization in our industry.',
                'column' => json_encode(['key1' => 'Value3', 'key2' => 'Value4']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'about_content_id' => 1,
                'title' => 'Our Values',
                'description' => 'Honesty, integrity, and respect are at the core of our culture.',
                'column' => json_encode(['key1' => 'Value5', 'key2' => 'Value6']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('about_sections')->insert($aboutSections);
    }
}

