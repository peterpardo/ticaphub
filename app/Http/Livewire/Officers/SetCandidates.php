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

    public function render()
    {
        return view('livewire.officers.set-candidates', [
            'users' => User::whereHas('userElection', function ($query) {
                $query->where('election_id', $this->election->id);
            })->paginate(5),
            'positions' => Position::where('election_id', $this->election->id)->with(['candidates', 'candidates.user'])->paginate(5),
        ]);
    }
}
