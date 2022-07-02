<?php

namespace App\Http\Livewire\Settings;

use App\Models\Ticap;
use Livewire\Component;

class TicapForm extends Component
{
    public $showForm = false;
    public $ticap;
    public $name;

    protected $listeners = ['getTicap'];

    protected $rules = [
        'name' => 'required|string|max:30'
    ];

    public function getTicap($id) {
        $this->ticap = Ticap::find($id);
        $this->name = $this->ticap->name;
        $this->showForm = true;
    }

    public function closeModal() {
        $this->showForm = false;
        $this->reset();
        $this->resetValidation();
    }

    public function updateTicap() {
        $this->validate();

        // Update ticap name
        $this->ticap->name = $this->name;
        $this->ticap->save();

        // Close Modal
        $this->showForm = false;

        // Refresh parent component and return success message
        $this->emit('refreshParent', 'success');

        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.settings.ticap-form');
    }
}
