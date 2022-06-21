<?php

namespace Database\Seeders;

use App\Models\Election;
use App\Models\School;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FEU TECH
        School::create([
            'name' => 'FEU TECH',
            'is_involved' => 1,
        ]);

        // // // FEU DILIMAN
        School::create([
            'name' => 'FEU DILIMAN',
        ]);

        // // // FEU ALABANG
        School::create([
            'name' => 'FEU ALABANG',
        ]);
    }
}
