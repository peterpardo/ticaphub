<?php

namespace Database\Seeders;

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
        DB::table('schools')->insert([
            'name' => 'FEU Tech',
            'is_involved' => 1,
        ]);

        DB::table('schools')->insert([
            'name' => 'FEU Diliman',
            'is_involved' => 1,
        ]);

        DB::table('schools')->insert([
            'name' => 'FEU Alabang',
        ]);
    }
}
