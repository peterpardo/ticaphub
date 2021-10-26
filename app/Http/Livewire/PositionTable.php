<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;
use Illuminate\Support\Str;

class PositionTable extends Component
{   
    public $newPosition;
    public $positionId;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
    protected $rules = [
        'newPosition' => 'required'
    ];
    protected $messages = [
        'newPosition.required' => 'Position is required'
    ];

    public function deletePosition() {
        Position::find($this->positionId)->delete();
        $this->emit('positionDeleted');
    }
    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function selectPosition($id, $action) {
        $this->positionId = $id;
        if($action == 'update') {
            $this->emit('getPositionId', $id);
            $this->dispatchBrowserEvent('openUpdateModal');
        } else {
            $this->dispatchBrowserEvent('openDeleteModal');
        }
    }
    public function addPosition() {
        $this->validate();
        Position::create([ 'name' => Str::title($this->newPosition) ]);
        session()->flash('status', 'green');
        session()->flash('message', 'Position successfully added');
        $this->reset();
    }
    public function render()
    {
        $positions = Position::all();
        return view('livewire.position-table', [
            'positions' => $positions
        ]);
    }
}
