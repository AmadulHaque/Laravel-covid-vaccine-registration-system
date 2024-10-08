<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        $vaccineCenters = [
            ['name' => 'Community Health Center Dhaka',         'daily_limit' => 100],
            ['name' => 'Primary Health Center Mirpur',          'daily_limit' => 50],
            ['name' => 'Government Hospital Mohakhali',         'daily_limit' => 200],
            ['name' => 'District Hospital Uttara',              'daily_limit' => 150],
            ['name' => 'Medical College Hospital Rajshahi',     'daily_limit' => 300],
        ];
        VaccineCenter::insert($vaccineCenters);
    }
}
