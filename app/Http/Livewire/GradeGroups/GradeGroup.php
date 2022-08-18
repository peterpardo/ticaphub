<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Group;
use App\Models\Specialization;
use Illuminate\Support\Arr;
use Livewire\Component;

class GradeGroup extends Component
{
    public $awardId;
    public $awardName;
    public $specializationId;
    public $specializationName;
    public $groups = [];
    public $groupGrades = [];
    public $criteria;

    public function mount() {
        $award = Award::find($this->awardId);
        $this->awardName = $award->name;
        $this->specializationId = $award->specialization_id;
        $this->specializationName = Specialization::where('id', $award->specialization_id)->pluck('name')->first();
        $groups = Group::select('id', 'name')->where('specialization_id', $award->specialization_id)
            ->with(['groupGrades' => function ($query) use ($award) {
                $query->select('id', 'group_id', 'criteria_id', 'grade')
                    ->where('award_id', $award->id)
                    ->where('user_id', auth()->user()->id);
            }])
            ->get()
            ->toArray();
        $this->criteria = Criteria::select('id', 'name', 'percentage')
            ->where('rubric_id', $award->rubric_id)
            ->get();

        // Create array with group grades
        foreach ($groups as $group) {
            $groupGrades = [0 => []];
            $totalGrade = 0;
            // criteria_id => grade
            foreach ($group['group_grades'] as $groupGrade) {
                $groupGrades[0][$groupGrade['criteria_id']] = $groupGrade['grade'];
                $totalGrade += $groupGrade['grade'];
            }

            // Push group details to new array
            $this->groups[] = [
                'id' => $group['id'],
                'name' => $group['name'],
                'total_grade' => $totalGrade,
                'group_grades' => $groupGrades[0],
            ];
        }
    }

    public function render()
    {
        return view('livewire.grade-groups.grade-group');
    }
}
