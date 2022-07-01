<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Ticap;
use App\Models\User;
use Livewire\Component;

class SetTicap extends Component
{
    public $name = '';
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:50|unique:ticaps,name',
    ];

    public function updatedName() {
        $this->resetValidation('name');
    }

    public function setTicap() {
        $this->validate();

        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;
    }

    public function confirmTicap() {
        // Create ticap
        $ticap = Ticap::create([
            'name' => $this->name,
        ]);

        // Get admins
        $admins = User::role(['superadmin', 'admin'])->get();

        // Set ticap id of admins
        foreach($admins as $admin) {
            $admin->ticap_id = $ticap->id;
            $admin->save();
        }

        // TODO: Set ticap id of default events

        // Set flash data
        session()->flash('status', 'green');
        session()->flash('message', 'Welcome to TICAPHUB! TICAP has been set.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.set-ticap');
    }
}
