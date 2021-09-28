<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Officer;
use App\Models\Position;
use App\Models\Ticap;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewElection extends Component
{
    public $elections;
    public $positions;

    public function getElectionResults() {
        $candidateVoteCount = [];
        foreach($this->elections as $election) {
            if($election->officers()->where('is_elected', 0)->exists()) {
                foreach($this->positions as $position) {
                    foreach($election->candidates->where('position_id', $position->id) as $candidate) {
                        $candidateVoteCount[$candidate->id] = $candidate->votes->count();
                    }
                    $electedOfficer = array_keys($candidateVoteCount, max($candidateVoteCount));
                    dd($electedOfficer);
                    if(count($electedOfficer) == 1) {
                        // $loser = array_keys($electedOfficer, min($electedOfficer));
                        $candidate = Candidate::find($electedOfficer[0]);
                        Officer::where('candidate_id', $candidate->id)->update(['is_elected' => 1]);
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
        }
        Ticap::find(Auth::user()->ticap_id)->update(['election_review' => 1]);
        return redirect()->route('election-result');
    }
    public function closeConfirmationModal() {
        $this->dispatchBrowserEvent('closeConfModal');
    }
    public function confirmElection() {
         // VALIDATE ELECTION
        //  foreach($this->elections as $election) {
        //     if($election->officers()->where('is_elected', 1)->exists()) {
        //         $userCount = $election->userElections->count() / 2;
        //         if($election->userElections->where('has_voted', 1)->count() < (int)round($userCount)){
        //             session()->flash('status', 'red');
        //             session()->flash('message', $election->name . ' - has LESS THAN HALF the votes needed to proceed.');
        //             return back();
        //         }
        //     }
        // }
        $this->dispatchBrowserEvent('openConfModal');
    }
    public function render()
    {
        $this->elections = Election::all();
        $this->positions = Position::all();
        return view('livewire.new-election');
    }
}
