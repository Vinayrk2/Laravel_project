<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppelierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            ['url' => 'https://supplier1.com'],
            ['url' => 'https://supplier2.com'],
            ['url' => 'https://supplier3.com'],
            ['url' => 'https://supplier4.com'],
            ['url' => 'https://supplier5.com'],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
