<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use App\Models\UserElection;
use App\Models\Vote;
use Livewire\Component;

class ViewElection extends Component
{
    public Election $election;
    public $showResetModal = false;
    public $showConfirmModal = false;

    public function resetElection() {
        // delete all votes of the election
        Vote::where('election_id', $this->election->id)->delete();

        // set 'has_voted' column of user_election table from true to false if they have voted
        UserElection::where('election_id', $this->election->id)
            ->where('has_voted', 1)
            ->update(['has_voted' => 0]);

        // change status of election from 'in progress' to 'not started'
        $this->election->status = 'not started';
        $this->election->save();

        // redirect to the elections page (list of all elections)
        return redirect('officers/elections');
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
