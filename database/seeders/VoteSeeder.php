<?php

namespace Database\Seeders;

use App\Models\Candidate;
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
        $users = User::all();
        $candidates = Candidate::all();

        // FOR TESTING
        // DEFAULT POSITIONS (CHAIRMAN, CO-CHAIRMAN) 
        // DEFAULT SPECIALIZATIONS (WMA, DA) 
        $wmaChairman = [];
        $wmaCo = [];

        $daChairman = [];
        $daCo = [];


        foreach($candidates as $candidate){
            if($candidate->position_id == 1 && $candidate->specialization_id == 1){
                array_push($wmaChairman, $candidate->id);
            }
            if($candidate->position_id == 2 && $candidate->specialization_id == 1){
                array_push($wmaCo, $candidate->id);
            }
            if($candidate->position_id == 1 && $candidate->specialization_id == 2){
                array_push($daChairman, $candidate->id);
            }
            if($candidate->position_id == 2 && $candidate->specialization_id == 2){
                array_push($daCo, $candidate->id);
            }
        }
        
        
        foreach($users as $user){
            if($user->hasRole('student') && !$user->userProgram->has_voted){
                if($user->userProgram->specialization_id == 1){
                    $user->votes()->create([
                        'candidate_id' => $wmaChairman[array_rand($wmaChairman)],
                        'ticap_id' => $user->ticap_id,
                    ]);
                    $user->votes()->create([
                        'candidate_id' => $wmaCo[array_rand($wmaCo)],
                        'ticap_id' => $user->ticap_id,
                    ]);
                    $user->userProgram->has_voted = 1;
                    $user->userProgram->save();
                } 
                if($user->userProgram->specialization_id == 2){
                    $user->votes()->create([
                        'candidate_id' => $daChairman[array_rand($daChairman)],
                        'ticap_id' => $user->ticap_id,
                    ]);
                    $user->votes()->create([
                        'candidate_id' => $daCo[array_rand($daCo)],
                        'ticap_id' => $user->ticap_id,
                    ]);
                    $user->userProgram->has_voted = 1;
                    $user->userProgram->save();
                }
            }
        }

    }
}
