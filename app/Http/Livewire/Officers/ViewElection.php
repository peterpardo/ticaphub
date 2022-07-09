<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use Livewire\Component;

class ViewElection extends Component
{
    public Election $election;
    public $showResetModal = false;
    public $showConfirmModal = false;

    public function resetElection() {
        // delete all votes for each candidates
        // set 'has_voted' column of user_election table from true to false if they have voted
        // change status of election from 'in progress' to 'not started'
        // redirect to the elections page (list of all elections)
    }

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
