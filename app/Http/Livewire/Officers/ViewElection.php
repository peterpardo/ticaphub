<?php

namespace App\Http\Livewire\Officers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\UserElection;
use App\Models\Vote;
use Livewire\Component;

class ViewElection extends Component
{
    public Election $election;
    public $showResetModal = false;
    public $hasTiedCandidates = false;
    public $positions;
    public $studentCount;
    public $studentHasVotedCount;

    public function mount() {
        $this->updateVotes();
        // Check if election has tied candidates
        $this->hasTiedCandidates = Candidate::where('election_id', $this->election->id)
            ->where('status', 'red')->exists();
    }

    public function updateVotes() {
        $this->positions = Position::where('election_id', $this->election->id)
            ->with([
                'candidates' => function ($query) {
                    $query->withCount('votes');
                },
                'candidates.user'
            ])
            ->get();
        $this->studentCount = UserElection::where('election_id', $this->election->id)->count();
        $this->studentHasVotedCount = UserElection::where('election_id', $this->election->id)
            ->where('has_voted', 1)
            ->count();
    }

    public function resetElection() {
        // delete all votes of the election
        Vote::where('election_id', $this->election->id)->delete();

        // set 'has_voted' column of user_election table from true to false if they have voted
        UserElection::where('election_id', $this->election->id)
            ->where('has_voted', 1)
            ->update(['has_voted' => 0]);

        // changes status of candidates to null
        Candidate::where('election_id', $this->election->id)->update(['status' => null]);

        // change status of election from 'in progress' to 'not started'
        // change in_review column to false
        $this->election->status = 'not started';
        $this->election->in_review = false;
        $this->election->save();

        // redirect to the elections page (list of all elections)
        return redirect('officers/elections');
    }

    public function endElection() {
        // Reset hasTiedCandidates property
        $this->reset('hasTiedCandidates');

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
                Candidate::whereIn('id', $result)->update(['status' => 'red']);
                $this->hasTiedCandidates = true;
            } else {
                Candidate::where('id', $result[0])->update(['status' => 'green']);

                // set is_done column of position to true
                $position->is_done = true;
                $position->save();
            }
        }

        // Show alert message
        session()->flash('status', 'green');
        session()->flash('message', 'Voting of candidates is finished. Election is now in review.');

        // Set the election 'in_review' to true
        $this->election->in_review = true;
        $this->election->save();

        return redirect('officers/elections/' . $this->election->id);
    }

    public function redoElection() {
        dd('redo election');
        // delete all votes for the position with tied candidates
        // set has_voted column of user_election (students) to false to allow them to vote again
        // set 'in_review' to false
        // delete candidates whose status is still null after ending election
    }

    public function render()
    {
        return view('livewire.officers.view-election');
    }
}
