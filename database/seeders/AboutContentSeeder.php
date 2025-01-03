<?php

// database/seeders/AboutContentSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutContentSeeder extends Seeder
{
    public function run()
    {
        DB::table('about_contents')->insert([
            'main_description' => 'Serving all of Western Canada, we offer sales of new and used equipment as well as installations on both commercial and private planes. We specialize in avionics line maintenance, retrofits, and component repairs. We’re a Transport Canada approved organization and have been in business since 1979, serving all sectors of the aviation industry.',
            'field1' => 'Mission',
            'field1_description' => 'To be an enduring company by creating superior products for automotive, aviation, marine, outdoor, and sports that are an essential part of our customers’ lives.',
            'field2' => 'Vision',
            'field2_description' => 'The Aviation Gateway and Key Economic Driver for Central Alberta.',
            'field3' => 'Values',
            'field3_description' => 'The foundation of our culture is honesty, integrity, and respect for associates, customers, and business partners. Each associate is fully committed to serving customers and fellow associates through outstanding performance and accomplishing what we say we will do.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

