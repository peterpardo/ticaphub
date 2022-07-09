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

    // candidate_id => status (red or green)
    public $candidateStatus = [];

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

    public function endElection() {
        // Set the election 'in_review' to true
        $this->election->in_review = true;
        $this->election->save();

        // Get all candidates for each position
        $positions =  Position::select('id')
            ->where('election_id', $this->election->id)
            ->with(['candidates' => function ($query) {
                $query->withCount('votes');
            }])
            ->get();

        // Loop through each position
        foreach ($positions as $position) {
            $voteCounts = [];

            // Get all vote counts of each candidate and store in an array
            foreach ($position->candidates as $candidate) {
                $voteCounts[$candidate->id] = $candidate->votes_count; // candidate_id => vote count
            }

            // Get the candidate_id  of the highest vote count
            $result = array_keys($voteCounts, max($voteCounts));

            // If result is more than 2, there is a tie, set the bg color of the tied candidates to red
            if (count($result) > 1) {
                foreach ($result as $tiedCandidate) {
                    $this->candidateStatus[$tiedCandidate] = 'red';
                }
            } else {
                dd('one winner');
                $this->candidateStatus[$result[0]] = 'green';
            }
        }

        // Show alert message
        session()->flash('status', 'green');
        session()->flash('message', 'Voting of candidates is finished. Election is now in review.');

        $this->showConfirmModal = false;
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
            'studentCount' =>  UserElection::where('election_id', $this->election->id)->count(),
            'studentHasVotedCount' => UserElection::where('election_id', $this->election->id)
                ->where('has_voted', 1)
                ->count()
        ]);
    }
}
