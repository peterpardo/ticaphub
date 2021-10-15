<?php

namespace Database\Seeders;

use App\Models\Group;
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
            $group = Group::find(rand(1,3));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(4,6));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(7,9));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }

        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(10,12));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
    }
}
