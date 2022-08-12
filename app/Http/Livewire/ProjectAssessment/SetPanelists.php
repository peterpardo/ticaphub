<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class SetPanelists extends Component
{
    public Specialization $specialization;

    protected $listeners = ['refreshParent'];

    public function refreshParent($type) {
        if ($type == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Panelist has been successfully added');
        } else {
            session()->flash('status', 'green');
            session()->flash('message', 'Panelist has been successfully updated');
        }
    }

    public function render()
    {
        return view('livewire.project-assessment.set-panelists', [
            'panelists' => SpecializationPanelist::where('specialization_id', $this->specialization->id)->with('user:id,first_name,middle_name,last_name')->get(),
        ]);
    }
}
