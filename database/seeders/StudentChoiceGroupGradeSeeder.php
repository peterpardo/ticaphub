<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Specialization;
use App\Models\StudentChoiceVote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentChoiceGroupGradeSeeder extends Seeder
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
        $groups = Group::all();

        // RESET GRADES OF THE GROUPS (FOR WEB DEMO)
        foreach($groups as $group) {
            $group->awards()->detach();
        }
        
        // GRADE OF THE PANELIST TO THE CAPSTONE GROUPS
        foreach($specs as $spec) {
            foreach($spec->awards as $award) {
                foreach($spec->panelists as $panelist) {
                    foreach($spec->groups as $group) {
                        $total = 0;
                        foreach($award->awardRubric->rubric->criteria as $crit) {
                            $grade = rand(15, $crit->percentage);
                            $total += $grade;
                            $group->groupGrades()->create([
                                'criteria_id' => $crit->id,
                                'grade' => rand(10 , $crit->percentage),
                                'user_id' => $panelist->user->id,
                                'award_id' => $award->id
                            ]);
                        }
                        // SET FINAL GRADE OF THE FINALIST FOR THE GROUP
                        $group->panelistGrades()->create([
                            'total_grade' => $total,
                            'award_id' => $award->id,
                            'user_id' => $panelist->user->id
                        ]);
                    }
                }
            }
        }

        // PANELISTS
        $x = true;
        foreach($panelists as $panelist) {
            // SET THTE FIRST PANELIST NOT YET DONE FOR WEB DEMO (panelist@gmail.com)
            if($x) {
                $panelist->specializationPanelist->update_evaluation = 1;
                $panelist->specializationPanelist->evaluation_review = 0;
                $panelist->specializationPanelist->save();
                $x = false;
            } else {
                $panelist->specializationPanelist->is_done = 1;
                $panelist->specializationPanelist->evaluation_review = 1;
                $panelist->specializationPanelist->save();
            }
        }

        // STUDENT CHOICE VOTES
        // FEU TECH
        // WMA
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(1,3));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
        // DA
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(4,6));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
        // AGD
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(7,9));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
        // SMBA
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(10,12));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }

        // FEU DILIMAN
        // WMA
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(13,15));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
        // DA
        for($i = 0; $i < 100; $i++) {
            $group = Group::find(rand(16,18));
            StudentChoiceVote::create([
                'name' => Str::random(7),
                'email' => Str::random(5) . '@gmail.com',
                'group_id' => $group->id,
                'specialization_id' => $group->specialization->id,
            ]);
        }
    }
}
