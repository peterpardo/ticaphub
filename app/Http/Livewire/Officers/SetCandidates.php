<?php

namespace App\Http\Livewire\Officers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SetCandidates extends Component
{
    use WithPagination;

    public Election $election;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message = null) {
        if ($message === 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Candidate successfully added');
        } else if ($message === 'edit') {
            session()->flash('status', 'green');
            session()->flash('message', 'Candidate successfully updated');
        } else if ($message === 'error') {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Try again later.');
        }
    }

    public function render()
    {
        return view('livewire.officers.set-candidates', [
            'positions' => Position::where('election_id', $this->election->id)->with(['candidates', 'candidates.user'])->paginate(5),
        ]);
    }
}
