<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specs = Specialization::all();
        $panelists = User::role('panelist')->get();
        $gs = Group::all();
        foreach($gs as $g) {
            $g->awards()->detach();
        }
        // WMA
        // BEST CAPSTONE PROJECT
            // CYBER ACE
            // LSMR
            // ENVISIONER
        // BEST GROUP PRESENTER
            // CYBER ACE
            // LSMR
            // ENVISIONER    
        foreach($specs as $spec) {
            foreach($spec->awards as $award) {
                foreach($spec->groups as $group) {
                    $group->awards()->attach($award->id, ['total_grade' => rand(98, 100)]);
                }
            }
        }

        // PANELISTS
        foreach($panelists as $panelist) {
            $panelist->specializationPanelist->is_done = 1;
            $panelist->specializationPanelist->save();
        }


        
    }
}
