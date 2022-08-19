<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Group;
use App\Models\GroupGrade;
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
    public $isEditGrades = false;

    protected $rules = [
        'groups.*.group_grades.*' => 'numeric'
    ];

    protected $messages  = [
        'groups.*.group_grades.*.numeric' => 'Must be a number',
    ];

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

    public function saveChanges() {
        $this->validate();

        // Check if grade is less than or equal to the criteria percentage
        for ($i = 0; $i < count($this->groups); $i++) {
            foreach ($this->criteria as $criteria) {
                // Check if criteria has a grade
                if (array_key_exists($criteria->id, $this->groups[$i]['group_grades']) && $criteria->percentage < $this->groups[$i]['group_grades'][$criteria->id]) {
                    $this->addError('groups.' . $i . '.group_grades.' . $criteria->id, 'Must be not greater than ' . $criteria->percentage . '%');
                    return;
                }
            }

            // Check if record exists
            if (count($this->groups[$i]['group_grades']) > 0) {
                foreach($this->groups[$i]['group_grades'] as $criteriaId => $grade) {
                    GroupGrade::updateOrCreate(
                        ['group_id' => $this->groups[$i]['id'], 'criteria_id' => $criteriaId, 'award_id' => $this->awardId, 'user_id' => auth()->user()->id],
                        ['grade' => $grade]
                    );
                }
            }

            $this->groups[$i]['total_grade']  = array_sum($this->groups[$i]['group_grades']);
        }

        $this->isEditGrades = false;

        session()->flash('status', 'green');
        session()->flash('message', 'Grades successsfully updated.');
    }

    public function render()
    {
        return view('livewire.grade-groups.grade-group');
    }
}
