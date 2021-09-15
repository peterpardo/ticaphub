<?php

namespace Database\Seeders;

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

        Specialization::create([
            'name' => 'Web and Mobile Application'
        ]);

        Specialization::create([
            'name' => 'Digital Arts'
        ]);

        // Specialization::create([
        //     'name' => 'System Management and Business Analytics'
        // ]);

        // Specialization::create([
        //     'name' => 'Animation and Game Development'
        // ]);

    }
}
