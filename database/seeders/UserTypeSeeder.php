<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::firstOrCreate(['name' => 'Resident'], ['description' => 'Local resident user']);
        UserType::firstOrCreate(['name' => 'Non-Resident'], ['description' => 'Non-resident user']);
        UserType::firstOrCreate(['name' => 'Admin'], ['description' => 'System administrator']);
    }
}
