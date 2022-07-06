<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class SetPositions extends Component
{
    use WithPagination;

    public Election $election;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message = null) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Position successfully added');
        }
    }

    public function render()
    {
        return view('livewire.officers.set-positions', [
            'positions' => Position::where('election_id', $this->election->id)->paginate(5)
        ]);
    }
}
