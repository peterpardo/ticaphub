<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Criteria;
use App\Models\Rubric;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class RubricForm extends Component
{
    public $showModal = false;
    public $action = 'add';
    public $name;
    public $criteria = [''];
    public $selectedRubric;

    protected $rules = [
        'name' => 'required|string|min:3|max:50',
        'criteria.*.name' => 'required|min:3|max:50',
        'criteria.*.percentage' => 'required|numeric',
    ];

    protected $validationAttributes = [
        'criteria.*.name' => 'Criteria name',
        'criteria.*.percentage' => 'Criteria percentage'
,   ];

    protected $listeners = ['showModal'];

    public function showModal($type, $id = null) {
        // Check action of modal
        if ($type == 'edit') {
            $this->selectedRubric = $id;

            // Get rubric details and criteria
            $rubric = Rubric::find($id);
            $this->name = $rubric->name;
            $this->criteria = $rubric->criteria()->get(['id', 'name', 'percentage'])->toArray();

            $this->action = 'edit';
        }

        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('showModal', 'action', 'criteria', 'name');
    }

    public function addCriteria() {
        $this->criteria[] = '';
    }

    public function deleteCriteria($index) {
        // If count is 1, don't allow to delete criteria
        if (count($this->criteria) == 1) {
            return;
        }

        unset($this->criteria[$index]);
        $this->criteria = array_values($this->criteria);
    }

    public function saveRubric() {
        $this->validate();

        // Get total score
        $totalPercentage = 0;
        foreach ($this->criteria as $crit) {
            $totalPercentage += $crit['percentage'];
        }

        // total score should be 100
        if ($totalPercentage > 100 || $totalPercentage < 100) {
            session()->flash('status', 'red');
            session()->flash('message', 'The total score should be exact total of 100');
            return;
        }

        // Check if rubric is being added or updated
        if ($this->action == 'add') {
            $rubric = Rubric::create([
                'name' => $this->name,
            ]);

            if (!$rubric) {
                session()->flash('status', 'red');
                session()->flash('message', 'Something went wrong. Please try again.');
                return;
            }

            foreach ($this->criteria as $crit) {
                Criteria::create([
                    'name' => Str::title($crit['name']),
                    'percentage' => Str::title($crit['percentage']),
                    'rubric_id' => $rubric->id
                ]);
            }
        } else {
            // Update rubric name
            Rubric::where('id', $this->selectedRubric)->update(['name' => Str::title($this->name)]);

            // Create 2 empty arrays to store and compare the old and new criteria
            $tempArray = [];
            $tempArray2 = [];
            $oldCriteria = Criteria::select('id')->where('rubric_id', $this->selectedRubric)->get()->toArray();

            // Get the ids of all the old criteria and store in an empty array
            foreach ($oldCriteria as $old) {
                $tempArray[] = $old['id'];
            }

            // Get the ids of all the new criteria and store in an empty array
            foreach ($this->criteria as $crit) {
                // Add to empty array if id exists
                if (Arr::exists($crit, 'id')) {
                    $tempArray2[] = $crit['id'];
                }
            }

            // Get the difference of the arrays and delete the criteria
            foreach (array_diff($tempArray, $tempArray2) as $deletedCriteria) {
                Criteria::destroy($deletedCriteria);
            }

            // Update/add the rubric criteria
            foreach ($this->criteria as $crit) {
                if (Arr::exists($crit, 'id')) {
                    Criteria::where('id', $crit['id'])->update(['name' => $crit['name'], 'percentage' => $crit['percentage']]);
                } else {
                    Criteria::create([
                        'name' => Str::title($crit['name']),
                        'percentage' => Str::title($crit['percentage']),
                        'rubric_id' => $this->selectedRubric
                    ]);
                }
            }
        }

        $this->emitUp('refreshParent', $this->action);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.rubric-form');
    }
}
