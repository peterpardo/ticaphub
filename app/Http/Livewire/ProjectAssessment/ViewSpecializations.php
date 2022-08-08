<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class ViewSpecializations extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.project-assessment.view-specializations', [
            'specializations' => Specialization::with('school:id,name')->orderBy('school_id', 'asc')->paginate(5)
        ]);
    }
}
