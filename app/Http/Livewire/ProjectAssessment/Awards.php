<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Award;
use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class Awards extends Component
{
    use WithPagination;

    public Specialization $specialization;

    public function render()
    {
        return view('livewire.project-assessment.awards', [
            'awards' => Award::where('specialization_id', $this->specialization->id)->with('rubric:id,name')->paginate(5),
        ]);
    }
}
