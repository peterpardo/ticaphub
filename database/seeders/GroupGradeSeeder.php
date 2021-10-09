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
        foreach($panelists as $panelist) {
            $panelist->specializationPanelist->is_done = 1;
            $panelist->specializationPanelist->evaluation_review = 1;
            $panelist->specializationPanelist->save();
        }
    }
}
