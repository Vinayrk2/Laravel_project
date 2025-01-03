<?php

// database/seeders/HomeSectionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSectionSeeder extends Seeder
{
    public function run()
    {
        $homeSections = [
            ['created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('home_sections')->insert($homeSections);
    }
}
