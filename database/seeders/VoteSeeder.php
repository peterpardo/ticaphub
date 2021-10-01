<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elections = Election::all();
        $positions = Position::all();
        foreach($elections as $election) {
            foreach($election->userElections as $userElection) {
                foreach($positions as $position) {
                    $c = [];
                    foreach($election->candidates->where('position_id', $position->id) as $candidate) {
                        array_push($c, $candidate->id);
                    }
                    $userElection->user->votes()->create([
                        'candidate_id' => $c[array_rand($c)],
                        'ticap_id' => 1
                    ]);
                    $userElection->has_voted = 1;
                    $userElection->save();
                }
            }
        }
    }
}
