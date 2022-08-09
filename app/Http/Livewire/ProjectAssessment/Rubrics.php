<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Rubric;
use Livewire\Component;

class Rubrics extends Component
{
    public function render()
    {
        return view('livewire.project-assessment.rubrics', [
            'rubrics' => Rubric::withCount('criteria')->get(),
        ]);
    }
}
