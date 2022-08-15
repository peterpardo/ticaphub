<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Group;
use App\Models\Specialization;
use Livewire\Component;

class ReviewSettings extends Component
{
    public Specialization $specialization;
    public $showConfirmModal = false;
    public $groupCount;
    public $awardCount;
    public $panelistCount;
    public $groupsWithoutAdviser;

    public function mount() {
        $specialization = Specialization::withCount('awards', 'panelists')->find($this->specialization->id);
        $this->awardCount = $specialization->awards_count;
        $this->panelistCount = $specialization->panelists_count;

        $this->groupCount = Group::where('specialization_id', $this->specialization->id)->count();
        $this->groupsWithoutAdviser = Group::where('specialization_id', $this->specialization->id)
            ->where('adviser_id', null)
            ->get();
    }

    public function startAwarding() {
        // If group count is less than or equal to 0, don't allow to proceed
        if ($this->groupCount <= 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Must have groups before starting the awarding');

            $this->showConfirmModal = false;

            return;
        } else if ($this->groupsWithoutAdviser->count() > 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Some groups does not have a project adviser');

            $this->showConfirmModal = false;

            return;
        } else if ($this->awardCount <= 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Set awards before starting the awarding');

            $this->showConfirmModal = false;

            return;
        } else if ($this->panelistCount <= 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Set panelists before starting the awarding');

            $this->showConfirmModal = false;

            return;
        }

        // Change status of specialization
        $this->specialization->status = 'in progress';
        $this->specialization->save();

        // Redirect to view-panelists page
        session()->flash('status', 'green');
        session()->flash('message', 'Evaluation of panelists for this groups has started.');

        return redirect('/project-assessment/view-panelists/' . $this->specialization->id);
    }

    public function render()
    {
        return view('livewire.project-assessment.review-settings');
    }
}
