<?php

namespace Database\Seeders;

use App\Models\Officer;
use App\Models\Specialization;
use App\Models\Ticap;
use App\Models\UserProgram;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class ReduceHasVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Ticap::where('id', 1)->update(['election_finished' => 0]);
        Ticap::where('id', 1)->update(['has_new_election' => 0]);
        $specializations = Specialization::all();

        foreach($specializations as $specialization){
            foreach($specialization->userSpecialization as $user) {
                $user->has_voted = 0;
                $user->save();
            }
        }

        // DELETE ALL VOTES
        Vote::truncate();

        // DELETE OFFICERS
        Officer::truncate();
    }
}
