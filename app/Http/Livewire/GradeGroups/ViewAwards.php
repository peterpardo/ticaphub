<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\Award;
use App\Models\Specialization;
use Livewire\Component;

class ViewAwards extends Component
{
    public $specializationId;

    public function render()
    {
        return view('livewire.grade-groups.view-awards', [
            'awards' => Award::where('specialization_id', $this->specializationId)->get(),
            'specialization' => Specialization::with('school:id,name')->find($this->specializationId),
        ]);
    }
}
