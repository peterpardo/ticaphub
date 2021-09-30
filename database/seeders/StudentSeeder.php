<?php

namespace Database\Seeders;

use App\Models\Election;
use App\Models\Group;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mina = User::create([
            'first_name' => 'Mina',
            'middle_name' => 'Sharon',
            'last_name' => 'Myoui',
            'email' => 'stud@stud.com',
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'email_verified' => 1,
        ]);
        $mina->userSpecialization()->create([
            'specialization_id' => 1,
            'id_number' => 20181234
        ]);
        $spec = Specialization::find($mina->userSpecialization->specialization->id);
        $spec->election->userElections()->create([
            'user_id' => $mina->id,
        ]);
        $mina->userGroup()->create([
            'group_id' => 1
        ]);
        if(!$mina->userGroup->group->groupExhibit()->exists()) {
            $mina->userGroup->group->groupExhibit()->create([
                'ticap_id' => 1,
            ]);
        }
        $sana = User::create([
            'first_name' => 'Sana',
            'middle_name' => 'Sana',
            'last_name' => 'Minatozaki',
            'email' => 'stud2@stud2.com',
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'email_verified' => 1,
        ]);
        $sana->userSpecialization()->create([
            'specialization_id' => 2,
            'id_number' => 20181234
        ]);
        $spec = Specialization::find($sana->userSpecialization->specialization->id);
        $spec->election->userElections()->create([
            'user_id' => $sana->id,
        ]);
        $sana->userGroup()->create([
            'group_id' => 2
        ]);
        if(!$sana->userGroup->group->groupExhibit()->exists()) {
            $sana->userGroup->group->groupExhibit()->create([
                'ticap_id' => 1,
            ]);
        }
        $mina->assignRole('student');
        $sana->assignRole('student');
        for ($x = 0; $x < 44; $x++) {
            $user = \App\Models\User::create([
                'first_name' => Str::random(5),
                'middle_name' => Str::random(5),
                'last_name' => Str::random(5),
                'email' => Str::random(5) . "@" . Str::random(5) . ".com",
                'password' => Hash::make('123'), // password
                'remember_token' => Str::random(10),
                'ticap_id' => 1,
                'email_verified' => 1,
            ]);
            $flag = false;
            while(!$flag) {
                $spec = Specialization::find(rand(1,4));
                if($spec->userSpecializations->count() < 12) {
                    $user->userSpecialization()->create([
                        'specialization_id' => $spec->id,
                        'id_number' => rand(1,999999999),
                    ]);
                    $flag = true;
                }
            }
            // $user->userSpecialization()->create([
            //     'specialization_id' => rand(1,4),
            //     'id_number' => rand(1,999999999),
            // ]);
            $user->assignRole('student');
             // ASSIGN STUDENT WHICH ELECTION TO VOTE
            if($user->userSpecialization->specialization->school->id == 1) {
                $spec = Specialization::find($user->userSpecialization->specialization->id);
                $spec->election->userElections()->create([
                    'user_id' => $user->id,
                ]);
                $flag = false;
                while (!$flag) {
                    $group = Group::find(rand(1,12));
                    if($group->userGroups->count() < 4) {
                        $user->userGroup()->create([
                            'group_id' => $group->id
                        ]);
                        if(!$user->userGroup->group->groupExhibit()->exists()) {
                            $user->userGroup->group->groupExhibit()->create([
                                'ticap_id' => 1,
                            ]);
                        }
                        $flag = true;
                    }
                }
            }
            // else {
            //     if($user->userSpecialization->specialization->school->name == 'FEU DILIMAN') {
            //         $election = Election::with(['candidates'])->where('name', 'FEU DILIMAN')->first();
            //         $election->userElections()->create([
            //             'user_id' => $user->id,
            //         ]);
            //     } elseif($user->userSpecialization->specialization->school->name == 'FEU ALABANG') {
            //         $election = Election::with(['candidates'])->where('name', 'FEU ALABANG')->first();
            //         $election->userElections()->create([
            //             'user_id' => $user->id,
            //         ]);
            //     }
            // }
        }
    }
}
