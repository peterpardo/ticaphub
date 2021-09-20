<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Specialization;
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
   
        $user = User::find(2);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(4);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(5);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(6);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);
       
        $user = User::find(7);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(8);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(3);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(10);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(13);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 1,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);
        
        $user = User::find(14);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);
       
        $user = User::find(15);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);

        $user = User::find(18);
        $specialization = $user->userSpecialization->specialization_id;
        $school = $user->school->id;
        \App\Models\Candidate::create([
            'user_id' => $user->id,
            'position_id' => 2,
            'specialization_id' => $specialization,
            'school_id' => $school,
        ]);
    }
}
