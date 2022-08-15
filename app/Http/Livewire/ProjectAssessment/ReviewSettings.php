<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Group;
use App\Models\Specialization;
use Livewire\Component;

class ReviewSettings extends Component
{
    public Specialization $specialization;
    public $groupCount;
    public $groupsWithoutAdviser = false;

    public function mount() {
        $this->groupCount = Group::where('specialization_id', $this->specialization->id)->count();
        $this->groupsWithoutAdviser = Group::where('specialization_id', $this->specialization->id)
            ->where('adviser_id', null)
            ->get();
    }

    public function startAwarding() {
        dd('start awarding');
    }

    public function render()
    {
        return view('livewire.project-assessment.review-settings');
    }
}
