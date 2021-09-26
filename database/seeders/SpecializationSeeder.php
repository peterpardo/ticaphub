<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = School::where('is_involved', 1)->get();
        foreach($schools as $school) {
            $school->specializations()->create([
                'name' => 'FEU TECH | Web and Mobile Application',
            ]);
            $school->specializations()->create([
                'name' => 'FEU TECH | Digital Arts',
            ]);
        }
    }
}
