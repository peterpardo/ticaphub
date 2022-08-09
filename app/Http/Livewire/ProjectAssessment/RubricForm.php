<?php

namespace App\Http\Livewire\ProjectAssessment;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RubricForm extends Component
{
    public $showModal = false;
    public $action = 'add';
    public $name;
    public $criteria = [''];
    public $count = 0;

    protected $rules = [
        'name' => 'required|string|min:3|max:50',
        'criteria.*.name' => 'required|min:3|max:50',
        'criteria.*.percentage' => 'required|numeric|max:100',
    ];

    protected $validationAttributes = [
        'criteria.*.name' => 'Criteria name',
        'criteria.*.percentage' => 'Criteria percentage'
,   ];

    protected $listeners = ['showModal'];

    public function showModal($type) {
        // Check action of modal
        if ($type == 'edit') {
            $this->action = 'edit';
        }

        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('showModal', 'action');
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
        dd('save');
    }

    public function render()
    {
        return view('livewire.project-assessment.rubric-form');
    }
}
