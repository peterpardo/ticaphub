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
            PositionSeeder::class,
            TicapSeeder::class,
            EventSeeder::class,
            // GroupSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            // CandidateSeeder::class,
            // VoteSeeder::class,
        ]);
    }
}
