<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use Livewire\Component;

class ViewElection extends Component
{
    public Election $election;

    public function render()
    {
        return view('livewire.officers.view-election', [
            'positions' => Position::where('election_id', $this->election->id)
                ->with([
                    'candidates' => function ($query) {
                        $query->withCount('votes');
                    },
                    'candidates.user'
                ])
                ->paginate(5),
        ]);
    }
}
