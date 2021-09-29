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

        // // FOR TESTING
        // // DEFAULT POSITIONS (CHAIRMAN, CO-CHAIRMAN) 
        // // DEFAULT SPECIALIZATIONS (WMA, DA) 
        // $wmaChairman = [];
        // $wmaCo = [];

        // $daChairman = [];
        // $daCo = [];

        // // INSERT OFFICERS NOT YET ELECTED IN AN ARRAY
        // foreach($officers as $officer){
        //     if($officer->user->candidate->position_id == 1 && $officer->user->candidate->specialization_id == 1){
        //         array_push($wmaChairman, $officer->user->candidate->id);
        //     }
        //     if($officer->user->candidate->position_id == 2 && $officer->user->candidate->specialization_id == 1){
        //         array_push($wmaCo, $officer->user->candidate->id);
        //     }
        //     if($officer->user->candidate->position_id == 1 && $officer->user->candidate->specialization_id == 2){
        //         array_push($daChairman, $officer->user->candidate->id);
        //     }
        //     if($officer->user->candidate->position_id == 2 && $officer->user->candidate->specialization_id == 2){
        //         array_push($daCo, $officer->user->candidate->id);
        //     }
        // }

        // foreach($users as $user){
        //     if($user->hasRole('student') && !$user->userSpecialization->has_voted){
        //         if($user->userSpecialization->specialization_id == 1 && !$user->userSpecialization->has_voted){
        //             if(!empty($wmaChairman)){
        //                 $user->votes()->create([
        //                     'candidate_id' => $wmaChairman[array_rand($wmaChairman)],
        //                     'ticap_id' => $user->ticap_id,
        //                 ]);
        //             }
        //             if(!empty($wmaCo)){
        //                 $user->votes()->create([
        //                     'candidate_id' => $wmaCo[array_rand($wmaCo)],
        //                     'ticap_id' => $user->ticap_id,
        //                 ]);
        //             }
        //             $user->userSpecialization->has_voted = 1;
        //             $user->userSpecialization->save();
        //         } 
        //         if($user->userSpecialization->specialization_id == 2 && !$user->userSpecialization->has_voted){
        //             if(!empty($daChairman)){
        //                 $user->votes()->create([
        //                     'candidate_id' => $daChairman[array_rand($daChairman)],
        //                     'ticap_id' => $user->ticap_id,
        //                 ]);
        //             }
        //             if(!empty($daCo)){
        //                 $user->votes()->create([
        //                     'candidate_id' => $daCo[array_rand($daCo)],
        //                     'ticap_id' => $user->ticap_id,
        //                 ]);
        //             }
        //             $user->userSpecialization->has_voted = 1;
        //             $user->userSpecialization->save();
        //         }
        //     }
        // }

    }
}
