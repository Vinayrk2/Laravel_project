<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummyGalleryItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert 10 dummy gallery items
        for ($i = 0; $i < 10; $i++) {
            DB::table('gallery_items')->insert([
                'heading' => 'Heading ' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
