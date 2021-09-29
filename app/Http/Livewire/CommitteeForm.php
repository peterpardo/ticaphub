<?php

namespace App\Http\Livewire;

use App\Models\Committee;
use Livewire\Component;

class CommitteeForm extends Component
{
    public $name;
    public $commId;
    public $listeners = [
        'getCommId',
        'closeUpdateModal',
    ];

    public function updateCommittee() {
        $this->validate([
            'name' => 'required'
        ]);
        Committee::find($this->commId)->update(['name' => $this->name]);
        $this->emit('committeeUpdated');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function closeUpdateModal() {
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function getCommId($commId) {
        $this->commId = $commId;
        $committee = Committee::find($commId);
        $this->name = $committee->name;
    }
    public function render()
    {
        return view('livewire.committee-form');
    }
}
