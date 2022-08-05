<?php

namespace App\Http\Livewire\Documentation;

use App\Models\Election;
use App\Models\Specialization;
use App\Models\Ticap;
use Livewire\Component;

class Ticaps extends Component
{
    public $selectedTicap;
    public $showDeleteModal = false;

    public function selectItem($id) {
        $this->selectedTicap = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->showDeleteModal = false;
        $this->selectedTicap = null;
    }

    public function deleteItem() {
        // Delete Ticap
        if (Ticap::destroy($this->selectedTicap)) {
            session()->flash('status', 'green');
            session()->flash('message', 'TICaP successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong on our end. Please try again.');
        }

        // Close modal
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.documentation.ticaps', [
            'ticaps' => Ticap::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }
}
