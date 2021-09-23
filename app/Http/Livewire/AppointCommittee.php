<?php

namespace App\Http\Livewire;

use App\Models\Committee;
use App\Models\User;
use Livewire\Component;

class AppointCommittee extends Component
{
    public $search;
    public $name;

    public function render()
    {
        return view('livewire.appoint-committee', [
            'users' => User::search(trim($this->search))
                ->paginate(6),
            'committees' => Committee::with(['user'])->get()
        ]);
    }
    public function appoint($userId) {
        $this->validate([
            'name' => 'required',
        ]);
        $user = User::find($userId);
        $user->committee()->create([
            'name' => $this->name,
        ]);
        $user->assignRole('officer');
        $this->reset(['search', 'name']);
        session()->flash('status', 'green');
        session()->flash('message', 'Student successfully appointed.');
    }
    public function deleteCommittee($userId) {
        Committee::where('user_id', $userId)->delete();
        $user = User::find($userId);
        $user->removeRole('officer');
        session()->flash('status', 'green');
        session()->flash('message', 'Committee successfully deleted.');
    }
}
