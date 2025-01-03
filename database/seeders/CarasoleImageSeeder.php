<?php

// database/seeders/CarasoleImageSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarasoleImageSeeder extends Seeder
{
    public function run()
    {
        $carasoleImages = [
            ['home_id' => 1, 'image' => 'carasole1.png', 'created_at' => now(), 'updated_at' => now()],
            ['home_id' => 1, 'image' => 'carasole2.png', 'created_at' => now(), 'updated_at' => now()],
            ['home_id' => 1, 'image' => 'carasole3.png', 'created_at' => now(), 'updated_at' => now()],
            ['home_id' => 1, 'image' => 'carasole4.png', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('carasole_images')->insert($carasoleImages);
    }
}
