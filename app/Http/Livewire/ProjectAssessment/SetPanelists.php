<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class SetPanelists extends Component
{
    public Specialization $specialization;
    public $showDeleteModal;
    public $selectedPanelist;

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

    public function closeModal() {
        $this->reset('showDeleteModal', 'selectedPanelist');
    }

    public function selectItem($id) {
        $this->selectedPanelist = $id;
        $this->showDeleteModal = true;
    }

    public function deleteItem() {
        if (SpecializationPanelist::destroy($this->selectedPanelist) > 0) {
            session()->flash('status', 'green');
            session()->flash('message', 'Panelist has been successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Please try again.');
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.set-panelists', [
            'panelists' => SpecializationPanelist::where('specialization_id', $this->specialization->id)->with('user:id,first_name,middle_name,last_name')->get(),
        ]);
    }
}
