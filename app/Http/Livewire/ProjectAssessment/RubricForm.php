<?php

namespace App\Http\Livewire\ProjectAssessment;

use Livewire\Component;

class RubricForm extends Component
{
    public $action = 'add';
    public $name;
    public $critName = [];
    public $critPerc = [];
    public $count = 0;

    protected $rules = [
        'name' => 'required|string|min:3|max:50',
        'critName' => 'required',
        'critPerc' => 'required'
    ];

    protected $listeners = ['showModal'];

    public function showModal($type) {
        // Check action of modal
        if ($type == 'edit') {
            $this->action = 'edit';
        }
    }

    public function closeModal() {
        $this->reset('action', 'critName', 'critPerc');
        $this->emitUp('closeRubricForm');
    }

    public function addCriteria() {
        $this->count++;
        $this->dispatchBrowserEvent('addCriteriaBox', ['count' => $this->count]);
    }

    public function deleteCriteria($index) {
        // If count is 1, don't allow to delete criteria
        if ($this->count === 0) {
            return;
        }

        dd($index);
        unset($this->critName[$index]);
        unset($this->critPerc[$index]);
    }

    public function saveRubric() {
        dd('save');
    }

    public function render()
    {
        return view('livewire.project-assessment.rubric-form');
    }
}
