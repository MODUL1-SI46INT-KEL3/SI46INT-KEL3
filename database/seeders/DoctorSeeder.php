<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all specialization IDs
        $specializations = DB::table('specializations')->pluck('id')->toArray();
        
        // Create sample doctors
        DB::table('doctor')->insert([
            [
                'name' => 'Dr. John Smith',
                'email' => 'john.smith@telkomedika.com',
                'password' => Hash::make('password123'),
                'specialization_id' => $specializations[0], // Cardiology
                'working_hours' => '08:00 - 16:00',
                'phone' => '081234567890',
                'license_number' => 'DOC-001-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sarah Johnson',
                'email' => 'sarah.johnson@telkomedika.com',
                'password' => Hash::make('password123'),
                'specialization_id' => $specializations[1], // Dermatology
                'working_hours' => '09:00 - 17:00',
                'phone' => '081234567891',
                'license_number' => 'DOC-002-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Michael Chen',
                'email' => 'michael.chen@telkomedika.com',
                'password' => Hash::make('password123'),
                'specialization_id' => $specializations[2], // Endocrinology
                'working_hours' => '10:00 - 18:00',
                'phone' => '081234567892',
                'license_number' => 'DOC-003-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'email' => 'emily.rodriguez@telkomedika.com',
                'password' => Hash::make('password123'),
                'specialization_id' => $specializations[3], // Gastroenterology
                'working_hours' => '08:00 - 16:00',
                'phone' => '081234567893',
                'license_number' => 'DOC-004-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. David Kim',
                'email' => 'david.kim@telkomedika.com',
                'password' => Hash::make('password123'),
                'specialization_id' => $specializations[4], // Hematology
                'working_hours' => '09:00 - 17:00',
                'phone' => '081234567894',
                'license_number' => 'DOC-005-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
