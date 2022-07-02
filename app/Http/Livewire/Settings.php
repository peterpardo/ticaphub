<?php

namespace App\Http\Livewire;

use App\Models\Ticap;
use Livewire\Component;

class Settings extends Component
{
    public $isActive = 'settings';
    public Ticap $ticap;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'TICaP name successfully updated.');
        }
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
