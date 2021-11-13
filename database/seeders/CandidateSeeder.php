<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
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
        $ctr = 1;
        foreach($elections as $election) {
            if($ctr < 5){
                foreach($positions as $position) {
                    $users = User::wherehas('userSpecialization', function($q) use ($election){
                        $q->where('specialization_id', $election->specialization->id);
                    })->get();
                    $positionCount = 0;
                    foreach($users as $user) {
                        if(!Candidate::where('user_id', $user->id)->exists()) {
                            if($positionCount < 3){
                                $election->candidates()->create([
                                    'user_id' => $user->id,
                                    'position_id' => $position->id,
                                ]);
                                $positionCount++;
                            } else {
                                break;
                            }
                        }
                    }
                }
            } else {
                if($election->id == 5) {
                    foreach($positions as $position) {
                        $users = User::wherehas('userSpecialization', function($q) {
                            $q->wherehas('specialization', function($q) {
                                $q->where('school_id', 2);
                            });
                        })->get();
                        $positionCount = 0;
                        foreach($users as $user) {
                            if(!Candidate::where('user_id', $user->id)->exists()) {
                                if($positionCount < 3){
                                    $election->candidates()->create([
                                        'user_id' => $user->id,
                                        'position_id' => $position->id,
                                    ]);
                                    $positionCount++;
                                } else {
                                    break;
                                }
                            }
                        }
                    }
                } elseif ($election->id == 6) {
                    foreach($positions as $position) {
                        $users = User::wherehas('userSpecialization', function($q) {
                            $q->wherehas('specialization', function($q) {
                                $q->where('school_id', 3);
                            });
                        })->get();
                        $positionCount = 0;
                        foreach($users as $user) {
                            if(!Candidate::where('user_id', $user->id)->exists()) {
                                if($positionCount < 3){
                                    $election->candidates()->create([
                                        'user_id' => $user->id,
                                        'position_id' => $position->id,
                                    ]);
                                    $positionCount++;
                                } else {
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            $ctr++;
        }
    }
}
