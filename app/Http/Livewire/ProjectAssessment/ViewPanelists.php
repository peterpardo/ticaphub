<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class ViewPanelists extends Component
{
    public Specialization $specialization;

    public function updateAwards() {
        dd('updating awards');
    }

    public function endAwarding() {
        dd('ending the awarding');
    }

    public function render()
    {
        return view('livewire.project-assessment.view-panelists', [
            'panelists' => SpecializationPanelist::where('specialization_id', $this->specialization->id)->get(),
        ]);
    }
}
