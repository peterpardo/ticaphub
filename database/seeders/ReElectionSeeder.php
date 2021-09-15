<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ReElectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $wmaChairman = [1,3];
        $wmaCo = [4,5];

        foreach($users as $user){
            if($user->hasRole('student') && $user->user){
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
            }
        }
    }
}
