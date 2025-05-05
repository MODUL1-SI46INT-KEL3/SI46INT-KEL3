<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Run the specialization seeder first (since doctors depend on specializations)
        $this->call(SpecializationSeeder::class);
        
        // Then run the doctor seeder
        $this->call(DoctorSeeder::class);
    }
}
