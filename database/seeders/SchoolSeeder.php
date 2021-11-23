<?php

namespace Database\Seeders;

use App\Models\School;
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
        $school = School::create([
            'name' => 'FEU TECH',
            'is_involved' => 1,
        ]);
        $school->specializations()->create([
            'name' => 'Web and Mobile Application',
        ]);
        $school->specializations()->create([
            'name' => 'Digital Arts',
        ]);
        $school->specializations()->create([
            'name' => 'Animation and Game Development',
        ]);
        $school->specializations()->create([
            'name' => 'Service Management and Business Analytics',
        ]);
        // // // FEU DILIMAN
        $school = School::create([
            'name' => 'FEU DILIMAN',
            // 'is_involved' => 1,
        ]);
        // $school->specializations()->create([
        //     'name' => 'Twice',
        // ]);
        // $school->specializations()->create([
        //     'name' => 'Blackpink',
        // ]);
        // // // FEU ALABANG
        $school = School::create([
            'name' => 'FEU ALABANG',
            // 'is_involved' => 1,
        ]);
        // $school->specializations()->create([
        //     'name' => 'Everglow',
        // ]);
        // $school->specializations()->create([
        //     'name' => 'RedVelvet',
        // ]);
    }
}
