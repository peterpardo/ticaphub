<?php

namespace App\Http\Livewire;

use App\Models\Committee;
use App\Models\User;
use Livewire\Component;

class AppointCommittee extends Component
{
    public $search;
    public $name;
    public $committees;
    public $commId;
    public $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function selectCommittee($commId, $action) {
        $this->commId = $commId;
        if($action == 'delete') {
            $this->dispatchBrowserEvent('openDeleteModal');
        } else {
            $this->emit('getCommId', $commId);
            $this->dispatchBrowserEvent('openUpdateModal');
        }
    }
    public function appoint($userId) {
        $this->validate([
            'name' => 'required',
        ]);
        $user = User::find($userId);
        if($user->hasRole(['officer', 'chairman'])){
            session()->flash('status', 'red');
            session()->flash('message', 'Student already an officer.');
        } else {
            $user->committee()->create([
                'name' => $this->name,
            ]);
            $user->assignRole('officer');
            $this->reset();
            session()->flash('status', 'green');
            session()->flash('message', 'Student successfully appointed.');
        }
    }
    public function deleteCommittee() {
        $committee = Committee::find($this->commId);
        $user = User::find($committee->user->id);
        $user->removeRole('officer');
        $committee->delete();
        $this->emit('committeeDeleted');
    }
    public function render()
    {
        $this->committees = Committee::all();
        return view('livewire.appoint-committee', [
            'users' => User::role('student')->search(trim($this->search))->paginate(6),
        ]);
    }
}
