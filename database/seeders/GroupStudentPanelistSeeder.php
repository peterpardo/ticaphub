<?php

namespace Database\Seeders;

use App\Models\Election;
use App\Models\Group;
use App\Models\Specialization;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GroupStudentPanelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // GENERATE GROUPS
        // FEU TECH

        if(!Group::where('name', 'CYBER ACE')->exists()) {
            Group::create([
                'name' => 'Cyber Ace',
                'specialization_id' => 1,
                'ticap_id' => Ticap::latest()->pluck('id')->first(),
            ]);
        }

        Group::create([
            'name' => 'A-TEAM',
            'specialization_id' => 1,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Code Brewers',
            'specialization_id' => 1,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Envisioners',
            'specialization_id' => 2,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'BLANK',
            'specialization_id' => 2,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'JARS',
            'specialization_id' => 2,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ALPHA',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ASTRATECH',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ETERNALS',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Technocrats',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'QUATROSYS',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'TEAMWARE',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        // FEU DILIMAN
        Group::create([
            'name' => 'CHAPO',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Innovatech',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'CodeGent',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'InnTech',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Bro Code',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'TECHLANCE',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        
        // GENERATE STUDENTS
        for ($x = 0; $x < 71; $x++) {
            $user = User::factory()->create();
            $flag = false;
            while(!$flag) {
                $spec = Specialization::find(rand(1,6));
                // RUNS IF THE SPECIALIZATION HAS LESS THAN 12 STUDENTS 
                if($spec->userSpecializations->count() < 12) {
                    $user->userSpecialization()->create([
                        'specialization_id' => $spec->id,
                        'id_number' => rand(1,999999999),
                    ]);
                    $flag = true;
                }
            }
            $user->assignRole('student');
             // ASSIGN STUDENT WHICH ELECTION TO VOTE
            if($user->userSpecialization->specialization->school->id == 1) {
                $spec = Specialization::find($user->userSpecialization->specialization->id);
                $spec->election->userElections()->create([
                    'user_id' => $user->id,
                ]);
                $flag = false;
                while (!$flag) {
                    // ASSIGN STUDENT TO A GROUP IN FEU TECH
                    $group = Group::find(rand(1,12));
                    // RUNS IF THE GROUP HAS LESS THAN 4 STUDENTS
                    if($group->userGroups->count() < 4) {
                        $user->userGroup()->create([
                            'group_id' => $group->id
                        ]);
                        if(!$user->userGroup->group->groupExhibit()->exists()) {
                            $user->userGroup->group->groupExhibit()->create([
                                'ticap_id' => Ticap::latest()->pluck('id')->first(),
                            ]);
                        }
                        $flag = true;
                    }
                }
            } else {
                if($user->userSpecialization->specialization->school->name == 'FEU DILIMAN') {
                    $election = Election::where('name', 'FEU DILIMAN')->first();
                    $election->userElections()->create([
                        'user_id' => $user->id,
                    ]);
                    $flag = false;
                    while (!$flag) {
                        // ASSIGN STUDENT TO A GROUP IN FEU DILIMAN
                        $group = Group::find(rand(13,18));
                        // RUNS IF THE GROUP HAS LESS THAN 4 STUDENTS
                        if($group->userGroups->count() < 4) {
                            $user->userGroup()->create([
                                'group_id' => $group->id
                            ]);
                            if(!$user->userGroup->group->groupExhibit()->exists()) {
                                $user->userGroup->group->groupExhibit()->create([
                                    'ticap_id' => Ticap::latest()->pluck('id')->first(),
                                ]);
                            }
                            $flag = true;
                        }
                    }
                } elseif($user->userSpecialization->specialization->school->name == 'FEU ALABANG') {
                    $election = Election::where('name', 'FEU ALABANG')->first();
                    $election->userElections()->create([
                        'user_id' => $user->id,
                    ]);
                }
            }
        }

        // GENERATE PANELIST
        // PANELIST USED FOR WEB DEMO
        $panel = User::create([
            'first_name' => 'Mary Jane',
            'middle_name' => 'Moore',
            'last_name' => 'Doe',
            'email' =>  "panelist@gmail.com",
            'password' => Hash::make('thisispanelist'), // password
            'remember_token' => Str::random(10),
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
            'email_verified' => 1,
        ]);
        $panel->assignRole('panelist');
        // DUMMY PANELISTS
        for($i = 0; $i < 17; $i++) {
            $user = User::factory()->create();
            $user->assignRole('panelist');
        }
    }
}
