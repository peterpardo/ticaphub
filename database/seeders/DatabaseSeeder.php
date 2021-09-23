<?php

namespace Database\Seeders;

use App\Models\Group;
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
            TicapSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            CandidateSeeder::class,
            // VoteSeeder::class,
        ]);
    }
}
