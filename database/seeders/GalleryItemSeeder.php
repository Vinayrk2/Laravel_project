<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryItemSeeder extends Seeder
{
    public function run()
    {
        $galleryItems = [
            ['heading' => 'Gallery Item 1', 'created_at' => now(), 'updated_at' => now()],
            ['heading' => 'Gallery Item 2', 'created_at' => now(), 'updated_at' => now()],
            ['heading' => 'Gallery Item 3', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('gallery_items')->insert($galleryItems);
    }
}
