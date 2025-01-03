<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyGalleryItemDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all gallery items
        $galleryItems = DB::table('gallery_items')->get();

        // For each gallery item, add 3 dummy details
        foreach ($galleryItems as $item) {
            for ($i = 0; $i < 3; $i++) {
                DB::table('gallery_item_details')->insert([
                    'gallery_item_id' => $item->id,
                    'image' => 'image_' . $item->id . '_' . $i . '.jpg',
                    'description' => 'This is a dummy description for gallery item ' . $item->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
