<?php

namespace Database\Seeders;

use App\Models\Election;
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
        // $schools = School::where('is_involved', 1)->get();
        // foreach($schools as $school) {
        //     $school->specializations()->create([
        //         'name' => 'FEU TECH | Web and Mobile Application',
        //     ]);
        //     $school->specializations()->create([
        //         'name' => 'FEU TECH | Digital Arts',
        //     ]);
        // }

        $school = School::where('id', 1)->get();

        $election1 = Election::create([
            'name' => $school->name  . ' | Web and Mobile Application',
            'ticap_id' => 1,
        ]);
        $election2 = Election::create([
            'name' => $school->name  . ' | Digital Arts',
            'ticap_id' => 1,
        ]);
        $election3 = Election::create([
            'name' => $school->name  . ' | Animation and Game Development',
            'ticap_id' => 1,
        ]);
        $election4 = Election::create([
            'name' => $school->name  . ' | Service Management and Business Analytics',
            'ticap_id' => 1,
        ]);

        Specialization::insert([
            'name' => 'Web and Mobile Application',
            'election_id' => $election1->id,
            'school_id' => $school->id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

        Specialization::insert([
            'name' => 'Digital Arts',
            'election_id' => $election2->id,
            'school_id' => $school->id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

        Specialization::insert([
            'name' => 'Animation and Game Development',
            'election_id' => $election3->id,
            'school_id' => $school->id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

        Specialization::insert([
            'name' => 'Service Management and Business Analytics',
            'election_id' => $election4->id,
            'school_id' => $school->id,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

    }
}
