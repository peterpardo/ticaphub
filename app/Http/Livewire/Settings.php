<?php

namespace App\Http\Livewire;

use App\Models\Ticap;
use Livewire\Component;

class Settings extends Component
{
    public $isActive = 'settings';
    public Ticap $ticap;

    public function render()
    {
        return view('livewire.settings');
    }
}
