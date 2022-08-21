<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Group;
use App\Models\GroupGrade;
use App\Models\SpecializationPanelist;
use App\Models\User;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::all(['id']);
        $panelists = SpecializationPanelist::where('specialization_id', 40)->get();

        foreach ($panelists as $panelist) {
            $awards = Award::where('specialization_id', $panelist->specialization_id)->get(['id', 'rubric_id']);

            foreach ($awards as $award) {
                $criteria = Criteria::where('rubric_id', $award->rubric_id)->get();

                foreach ($criteria as $crit) {
                    foreach ($groups as $group) {
                        GroupGrade::insert([
                            'group_id' => $group->id,
                            'criteria_id' => $crit->id,
                            'grade' => rand(10, $crit->percentage),
                            'award_id' => $award->id,
                            'user_id' => $panelist->user_id
                        ]);
                    }
                }
            }
        }

    }
}
