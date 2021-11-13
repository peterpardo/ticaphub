<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\SpecializationPanelist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetPanelistGroupAdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panelists = User::role('panelist')->get();
        $count = 0;
        $spec = 2;
        foreach($panelists as $p) {
            // ASSIGN PANELIST THAT IS NOT YET ASSIGNED TO A SPECIALIZATION
            if(!SpecializationPanelist::where('user_id', $p->id)->exists()) {
                // MAX OF 3 PANELIST PER SPECIALIZATION
                if($count < 3) {
                    SpecializationPanelist::create([
                        'specialization_id' => $spec,
                        'user_id' => $p->id,
                    ]);
                    $count++;
                } else {
                    $spec++;
                    SpecializationPanelist::create([
                        'specialization_id' => $spec,
                        'user_id' => $p->id,
                    ]);
                    $count = 1;
                }    
            }
        }

        // SET ADVISER NAMES AND EMAILS FOR CERTIFICATIONS
        $groups = Group::all();
        foreach($groups as $group) {
            // SET GROUP ADVISER IF IT'S STILL NULL
            if($group->adviser == null) {
                $group->adviser = Str::random(5) . ' ' . Str::random(5);
                $group->adviser_email = Str::random(5) . '@' . Str::random(5) . '.com';
                $group->save();
            }
        }
    }
}
