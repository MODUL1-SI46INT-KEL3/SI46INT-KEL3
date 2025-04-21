<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    public function run()
    {
        DB::table('specializations')->insert([
            ['name' => 'Cardiology'],
            ['name' => 'Dermatology'],
            ['name' => 'Endocrinology'],
            ['name' => 'Gastroenterology'],
            ['name' => 'Hematology'],
            ['name' => 'Infectious Disease'],
            ['name' => 'Nephrology'],
            ['name' => 'Neurology'],
            ['name' => 'Oncology'],
            ['name' => 'Pulmonology'],
            ['name' => 'Rheumatology'],
            ['name' => 'Urology'],
   ]);
}
}