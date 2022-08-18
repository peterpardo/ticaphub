<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Group;
use App\Models\Specialization;
use Livewire\Component;

class GradeGroup extends Component
{
    public $awardId;
    public $awardName;
    public $specializationName;
    public $groups;
    public $criteria;

    public function mount() {
        $award = Award::find($this->awardId);
        $this->awardName = $award->name;
        $this->specializationName = Specialization::where('id', $award->specialization_id)->pluck('name')->first();
        $this->groups = Group::select('id', 'name')->where('specialization_id', $award->specialization_id)
            ->with(['groupGrades' => function ($query) use ($award) {
                $query->select('id', 'group_id', 'criteria_id', 'grade')
                    ->where('award_id', $award->id)
                    ->where('user_id', auth()->user()->id);
            }])
            ->get();
        $this->criteria = Criteria::select('id', 'name', 'percentage')->where('rubric_id', $award->rubric_id)->get();
        // dd($this->groups);
        // foreach ($this->groups as $group) {
        //     echo '<pre>';
        //     print_r($group['name'] . ' ');
        //     $total = 0;
        //     foreach($this->criteria as $crit) {
        //         // Check if group already has grades
        //         if (count($group['group_grades']) > 0) {
        //             foreach ($group['group_grades'] as $group_grade) {
        //                 // check if crit matches the grade
        //                 if ($group_grade['criteria_id'] != $crit['id']) {
        //                     continue;
        //                 }
        //                 print_r(number_format($group_grade['grade'], 1) . ' ');

        //                 // Get sum of all the grades
        //                 $total += $group_grade['grade'];
        //             }
        //         } else {
        //             // if group has no grades, show 0.0
        //             echo '0.0 ';
        //         }
        //     }
        //     echo 'Total: ' . number_format($total, 1);
        //     echo '</pre>';
        //     echo '<br/>';
        // }
        // die;
    }

    public function render()
    {
        return view('livewire.grade-groups.grade-group');
    }
}
