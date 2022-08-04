<?php

namespace App\Http\Livewire\Documentation;

use App\Models\Election;
use App\Models\Specialization;
use Livewire\Component;

class Ticaps extends Component
{
    public $selectedSpecialization;
    public $showDeleteModal = false;

    public function selectItem($id) {
        $this->selectedSpecialization = $id;

        $this->showDeleteModal = true;
    }

    public function closeModal($modal) {
        if ($modal === 'delete') {
            $this->showDeleteModal = false;
        }
    }

    public function deleteItem() {
        $specialization = Specialization::where('id', $this->selectedSpecialization)->with('election:id')->get()->first();

        // Check school of specialization
        if ($specialization->school_id === 1) {
            // Delete election and specialization
            Election::destroy($specialization->election->id);
        } else {
            // Delete only specialization
            Specialization::destroy($this->selectedSpecialization);
        }

        // // Reset properties to default value
        $this->reset(['selectedSpecialization']);

        // // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'Specialization successfully deleted');

        // Close modal
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.documentation.ticaps', [
            'specializations' => Specialization::orderBy('school_id')->with('school')->paginate(5)
        ]);
    }
}
