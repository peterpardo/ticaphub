<?php

namespace App\Http\Livewire;

use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class PanelistTable extends Component
{   
    public $panelistId;
    
    public function render()
    {
        return view('livewire.panelist-table', [
            'specializations' => Specialization::all(),
        ]);
    }
    public function deletePanelist($panelistId) {
        $this->panelistId = $panelistId;
        $this->dispatchBrowserEvent('openDeleteModal');
    }
    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function delete() {
        SpecializationPanelist::where('user_id', $this->panelistId)->delete();
        $this->emit('panelistDeleted');
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
}
