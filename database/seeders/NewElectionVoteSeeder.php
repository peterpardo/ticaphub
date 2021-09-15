<?php

namespace Database\Seeders;

use App\Models\Officer;
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
        $officers = Officer::where('is_elected', 0)->get();
        $users = User::all();

        // FOR TESTING
        // DEFAULT POSITIONS (CHAIRMAN, CO-CHAIRMAN) 
        // DEFAULT SPECIALIZATIONS (WMA, DA) 
        $wmaChairman = [];
        $wmaCo = [];

        $daChairman = [];
        $daCo = [];

        // INSERT OFFICERS NOT YET ELECTED IN AN ARRAY
        foreach($officers as $officer){
            if($officer->candidate->position_id == 1 && $officer->candidate->specialization_id == 1){
                array_push($wmaChairman, $officer->candidate->id);
            }
            if($officer->candidate->position_id == 2 && $officer->candidate->specialization_id == 1){
                array_push($wmaCo, $officer->candidate->id);
            }
            if($officer->candidate->position_id == 1 && $officer->candidate->specialization_id == 2){
                array_push($daChairman, $officer->candidate->id);
            }
            if($officer->candidate->position_id == 2 && $officer->candidate->specialization_id == 2){
                array_push($daCo, $officer->candidate->id);
            }
        }

        foreach($users as $user){
            if($user->hasRole('student') && !$user->userProgram->has_voted){
                if($user->userProgram->specialization_id == 1 && !$user->userProgram->has_voted){
                    if(!empty($wmaChairman)){
                        $user->votes()->create([
                            'candidate_id' => $wmaChairman[array_rand($wmaChairman)],
                            'ticap_id' => $user->ticap_id,
                        ]);
                    }
                    if(!empty($wmaCo)){
                        $user->votes()->create([
                            'candidate_id' => $wmaCo[array_rand($wmaCo)],
                            'ticap_id' => $user->ticap_id,
                        ]);
                    }
                    $user->userProgram->has_voted = 1;
                    $user->userProgram->save();
                } 
                if($user->userProgram->specialization_id == 2 && !$user->userProgram->has_voted){
                    if(!empty($daChairman)){
                        $user->votes()->create([
                            'candidate_id' => $daChairman[array_rand($daChairman)],
                            'ticap_id' => $user->ticap_id,
                        ]);
                    }
                    if(!empty($daCo)){
                        $user->votes()->create([
                            'candidate_id' => $daCo[array_rand($daCo)],
                            'ticap_id' => $user->ticap_id,
                        ]);
                    }
                    $user->userProgram->has_voted = 1;
                    $user->userProgram->save();
                }
            }
        }

    }
}
