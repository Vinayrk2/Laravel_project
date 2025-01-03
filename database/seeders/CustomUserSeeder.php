<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert 10 dummy users
        for ($i = 0; $i < 10; $i++) {
            DB::table('custom_user')->insert([
                'username' => 'user_' . Str::random(5),
                'email' => 'user' . $i . '@example.com',
                'phone_number' => '123456789' . $i,
                'address' => '123 Example Street, City ' . $i,
                'first_name' => 'FirstName' . $i,
                'last_name' => 'LastName' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
