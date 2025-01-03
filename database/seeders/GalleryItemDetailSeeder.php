<?php

// database/seeders/GalleryItemDetailSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryItemDetailSeeder extends Seeder
{
    public function run()
    {
        $galleryItemDetails = [
            ['gallery_item_id' => 1, 'image' => 'image1.jpg', 'description' => 'Description for item 1', 'created_at' => now(), 'updated_at' => now()],
            ['gallery_item_id' => 1, 'image' => 'image2.jpg', 'description' => 'Another description for item 1', 'created_at' => now(), 'updated_at' => now()],
            ['gallery_item_id' => 2, 'image' => 'image3.jpg', 'description' => 'Description for item 2', 'created_at' => now(), 'updated_at' => now()],
            ['gallery_item_id' => 3, 'image' => 'image4.jpg', 'description' => 'Description for item 3', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('gallery_item_details')->insert($galleryItemDetails);
    }
}
