<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\SpecializationPanelist;
use App\Models\User;
use Livewire\Component;

class Specializations extends Component
{
    public User $panelist;

    public function render()
    {
        return view('livewire.grade-groups.specializations', [
            'specs' => SpecializationPanelist::where('user_id', $this->panelist->id)->with('specialization')->get()
        ]);
    }
}
