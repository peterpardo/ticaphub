<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SchoolSeeder::class,
            SpecializationSeeder::class,
            PositionSeeder::class,
            // TicapSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // CandidateSeeder::class
        ]);
    }
}
