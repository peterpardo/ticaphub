<?php

namespace Database\Seeders;

use App\Models\Election;
use App\Models\Officer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewElectionVoteSeeder extends Seeder
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
            foreach($positions as $position) {
                if($election->officers()->where('is_elected', 0)->where('position_id', $position->id)->exists()) {
                    foreach($election->userElections as $userElection) {
                        $c = [];
                        foreach($election->officers->where('is_elected', 0)->where('position_id', $position->id) as $officer) {
                            array_push($c, $officer->user->candidate->id);
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
}
