<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define some service types for variety
        $serviceTypes = ['Consulting', 'Maintenance', 'Development', 'Installation', 'Support'];

        // Generate 10 dummy services
        for ($i = 0; $i < 10; $i++) {
            DB::table('services')->insert([
                'name' => 'Service ' . Str::random(6),
                'image' => 'service_' . $i . '.jpg', // Optional: Set an image or use default
                'status' => $i % 2 === 0, // Alternate between active (true) and inactive (false)
                'description' => 'This is a dummy description for Service ' . $i . '. It describes the nature of the service and its benefits.',
                'service_type' => $serviceTypes[array_rand($serviceTypes)], // Random service type
                'specifications' => json_encode([
                    'specification1' => 'Specification detail 1 for service ' . $i,
                    'specification2' => 'Specification detail 2 for service ' . $i,
                    'specification3' => 'Specification detail 3 for service ' . $i,
                ]),
                'technical_information' => json_encode([
                    'tech_info1' => 'Technical information 1 for service ' . $i,
                    'tech_info2' => 'Technical information 2 for service ' . $i,
                    'tech_info3' => 'Technical information 3 for service ' . $i,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
