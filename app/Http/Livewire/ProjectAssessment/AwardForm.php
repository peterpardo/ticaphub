<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Award;
use App\Models\Rubric;
use Livewire\Component;

class AwardForm extends Component
{
    public $specializationId;
    public $showModal = false;
    public $action = 'add';
    public $name;
    public $rubric;
    public $selectedAward;
    public $rubricPreview;

    protected $rules = [
        'name' => 'required|string|min:3|max:50',
        'rubric' => 'required|numeric'
    ];

    protected $listeners = ['showModal'];

    public function showModal($type, $id = null) {
        // Check action of modal
        if ($type == 'edit') {
            $this->selectedAward = $id;

            $this->action = 'edit';
        }

        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('showModal', 'action', 'rubric', 'name');
    }

    public function updatedRubric($value) {
        $this->rubricPreview = Rubric::where('id', $value)->with('criteria:id,rubric_id,name,percentage')->first();
    }

    public function saveAward() {
        $this->validate();

        // Check if action is add or updated award
        if ($this->action === 'add') {
            // Check if award name is unique
            if (Award::where('name', $this->name)->exists()) {
                $this->addError('name', 'Award name already exists.');
                return;
            }

            // Create award
            $award = Award::create([
                'name' => $this->name,
                'specialization_id' => $this->specializationId,
                'rubric_id' => $this->rubric,
            ]);

            // Check if award is created
            if (is_null($award)) {
                session()->flash('status', 'red');
                session()->flash('message', 'Something went wrong. Please try again.');
                return;
            }
        }

        $this->emitUp('refreshParent', $this->action);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.award-form', [
            'rubrics' => Rubric::all(['id', 'name']),
        ]);
    }
}
