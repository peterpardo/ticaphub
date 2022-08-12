<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\SpecializationPanelist;
use App\Models\User;
use Livewire\Component;

class PanelistForm extends Component
{
    public $specializationId;
    public $showModal = false;
    public $action = 'add';
    public $panelist;
    public $selectedPanelist;

    protected $rules = [
        'panelist' => 'required|numeric',
    ];

    protected $listeners = ['showModal'];

    public function showModal($type, $id = null) {
        // Check action of modal
        if ($type == 'edit') {
            $this->selectedPanelist = $id;

            // Get panelist details
            $panelist = SpecializationPanelist::select('id', 'user_id')->where('id', $id)->first();
            $this->panelist = $panelist->user_id;

            $this->action = 'edit';
        }

        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('showModal', 'action', 'panelist', 'selectedPanelist');
        $this->resetValidation();
    }

    public function savePanelist() {
        $this->validate();

        // Check if user is already a panelist to the specialization
        if (SpecializationPanelist::where('user_id', $this->panelist)->where('specialization_id', $this->specializationId)->exists()) {
            $this->addError('panelist', 'Panelist already exists in this specialization');
            return;
        }

        // Check if action is add or updated award
        if ($this->action == 'add') {
            // Add panelist
            $panelist = SpecializationPanelist::create([
                'user_id' => $this->panelist,
                'specialization_id' => $this->specializationId,
            ]);

            // Check if award is created
            if (is_null($panelist)) {
                session()->flash('status', 'red');
                session()->flash('message', 'Something went wrong. Please try again.');
                return;
            }
        } else {
            // Update panelist
            SpecializationPanelist::where('id', $this->selectedPanelist)->update(['user_id' => $this->panelist]);
        }

        $this->emitUp('refreshParent', $this->action);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.panelist-form', [
            'panelists' => User::role('panelist')->get(),
        ]);
    }
}
