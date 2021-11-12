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
            EventSeeder::class,
            UserSeeder::class,
            SliderSeeder::class,
            // TicapSeeder::class,
            // GroupSeeder::class,
            // RubricSeeder::class,
            // StudentSeeder::class,
            // PanelistSeeder::class,
            // CandidateSeeder::class,
            // VoteSeeder::class,
        ]);
    }
}
