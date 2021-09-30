<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;

class PositionForm extends Component
{   
    public $position;
    public $positionId;
    protected $listeners = [
        'getPositionId',
        'closeUpdateModal'
    ];

    public function closeUpdateModal() {
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function updatePosition() {
        $this->validate([
            'position' => 'required'
        ]);
        Position::find($this->positionId)->update(['name' => $this->position]);
        $this->emit('positionUpdated');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function getPositionId($id) {
        $this->positionId = $id;
        $position = Position::find($id);
        $this->position = $position->name;
    }
    public function render()
    {   
        return view('livewire.position-form');
    }
}
