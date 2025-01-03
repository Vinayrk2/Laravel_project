<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 10 dummy news entries
        for ($i = 0; $i < 10; $i++) {
            DB::table('news')->insert([
                'title' => 'Breaking News: ' . Str::random(10),
                'description' => 'This is a dummy description for news item ' . $i . '. ' .
                    'It provides an overview of the topic covered in this article.',
                'image' => $i % 2 === 0 ? 'image_' . $i . '.jpg' : null, // Assign image to half the records
                'url' => 'https://example.com/news-' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
