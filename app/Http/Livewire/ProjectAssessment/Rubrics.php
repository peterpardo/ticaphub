<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Rubric;
use Livewire\Component;

class Rubrics extends Component
{
    protected $listeners = ['refreshParent'];

    public function refreshParent($type) {
        if ($type == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Rubric has been successfully created');
        } else {
            session()->flash('status', 'green');
            session()->flash('message', 'Rubric has been successfully updated');
        }
    }

    public function render()
    {
        return view('livewire.project-assessment.rubrics', [
            'rubrics' => Rubric::withCount('criteria')->get(),
        ]);
    }
}
