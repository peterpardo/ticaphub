<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\GroupGrade;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class ViewPanelists extends Component
{
    public Specialization $specialization;
    public $showUpdateAwardModal = false;
    public $showEndAwardModal = false;

    public function showConfirmModal($action) {
        if ($action  == 'updateAwards') {
            $this->showUpdateAwardModal = true;
        } else {
            $this->showEndAwardModal = true;
        }
    }

    public function updateAwards() {
        // Delete all grades of paneslists for the selected specialization
        $panelists = SpecializationPanelist::where('specialization_id', $this->specialization->id)->get();
        foreach ($panelists as $panelist) {
            // Check if panelist has graded
            if (GroupGrade::where('user_id', $panelist->user_id)->exists()) {
                // Delete grades of panelists
                GroupGrade::where('user_id', $panelist->user_id)->delete();
            }

            // Set the 'is_done' of each panelist for the selected specialization to false
            $panelist->is_done = false;
            $panelist->save();
        }

        // Set the status of the specialization to 'not started'
        $this->specialization->status = 'not started';
        $this->specialization->save();

        session()->flash('status', 'green');
        session()->flash('message', $this->specialization->school->name . ' | ' . $this->specialization->name . ' awards has been reset');

        return redirect()->route('project-assessment');
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
