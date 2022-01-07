<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use App\Models\Ticap;
use App\Models\UserElection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ElectionPanel extends Component
{   
    public $elections;
    public $positions;

    public function getElectionResults() {
        $candidateVoteCount = [];
        foreach($this->elections as $election) {
            foreach($this->positions as $position) {
                foreach($election->candidates->where('position_id', $position->id) as $candidate) {
                    $candidateVoteCount[$candidate->id] = $candidate->votes->count();
                }
                $electedOfficer = array_keys($candidateVoteCount, max($candidateVoteCount));
                if(count($electedOfficer) == 1) {
                    $candidate = Candidate::find($electedOfficer[0]);
                    if($candidate->user->officer == null || !$candidate->user->officer->exists()){
                        $candidate->user->officer()->create([
                            'position_id' => $candidate->position->id,
                            'election_id' => $election->id,
                            'ticap_id' => $candidate->user->ticap_id,
                            'is_elected' => 1,
                        ]);
                    }  
                }  else {
                    foreach($electedOfficer as $candidate_id){
                        // INSERT CANDIDATE TO OFFICERS TABLE WITH (IS_ELECTED = FALSE)
                        $candidate = Candidate::find($candidate_id);
                        if($candidate->user->officer == null || !$candidate->user->officer->exists()){
                            $candidate->user->officer()->create([
                                'position_id' => $candidate->position->id,
                                'ticap_id' => $candidate->user->ticap_id,
                                'election_id' => $election->id,
                            ]);
                        }
                    }
                }
                $candidateVoteCount = [];
            }
            foreach($election->userElections->where('has_voted', 0) as $userElection) {
                $userElection->has_voted = 1;
                $userElection->save();
            }
        }
        Ticap::find(Auth::user()->ticap_id)->update(['election_review' => 1]);
        return redirect()->route('election-result');
    }
    public function closeConfirmationModal() {
        $this->dispatchBrowserEvent('closeConfModal');
    }
    public function endElection() {
        // VALIDATE ELECTION
        foreach($this->elections as $election) {
            $userCount = $election->userElections->count() / 2;
            if($election->userElections->where('has_voted', 1)->count() < (int)round($userCount)){
                session()->flash('status', 'red');
                session()->flash('message', $election->name . ' - has LESS THAN HALF the votes needed to proceed.');
                return back();
            }
        }
        $this->dispatchBrowserEvent('openConfModal');
    }
    public function render()
    {
        $this->elections = Election::all();
        $this->positions = Position::all();
        return view('livewire.election-panel');
    }
    public function openUpdateModal() {
        $this->dispatchBrowserEvent('openUpdateElectionModal');
    }
    public function closeUpdateModal() {
        $this->dispatchBrowserEvent('closeUpdateElectionModal');
    }
    public function updateElection() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $ticap->election_updated = 1;
        $ticap->save();
        return redirect()->route('set-candidates');
    }
}
