<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Rubric;
use Livewire\Component;

class Rubrics extends Component
{
    public $showRubricForm = false;

    protected $listeners = ['closeRubricForm'];

    public function showRubricForm() {
        $this->emitTo('project-assessment.rubric-form', 'showModal', 'add');
        $this->showRubricForm = true;
    }

    public function closeRubricForm() {
        $this->showRubricForm = false;
    }

    public function render()
    {
        return view('livewire.project-assessment.rubrics', [
            'rubrics' => Rubric::withCount('criteria')->get(),
        ]);
    }
}
