<?php

namespace Database\Seeders;

use App\Models\StudentChoiceVote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for($i = 0; $i < 100; $i++) {
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => rand(1,3),
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => rand(4,6),
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => rand(7,9),
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => rand(10,12),
            ]);
        }
    }
}
