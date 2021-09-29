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
            foreach($this->positions as $position) {
                if($election->officers()->where('is_elected', 0)->where('position_id', $position->id)->exists()) {
                    foreach($election->officers->where('is_elected', 0)->where('position_id', $position->id) as $officer) {
                        $candidate = $officer->user->candidate;
                        $candidateVoteCount[$candidate->id] = $candidate->votes->count();
                    }
                    $electedOfficer = array_keys($candidateVoteCount, max($candidateVoteCount));
                    if(count($electedOfficer) == 1) {
                        $candidate = Candidate::find($electedOfficer[0]);
                        Officer::where('user_id', $candidate->user->id)->update(['is_elected' => 1]);
                        foreach($candidateVoteCount as $candidateId => $votes) {
                            if($electedOfficer[0] == $candidateId) {
                                continue;
                            }
                            $c = Candidate::find($candidateId);
                            if(Officer::where('user_id', $c->user->id)->exists()){
                                Officer::where('user_id', $c->user->id)->delete();
                            }
                        }
                    }  else {
                        foreach($electedOfficer as $candidateId){
                            foreach($candidateVoteCount as $id => $votes){
                                if($id == $candidateId){
                                    continue;
                                }
                                $c = Candidate::find($id);
                                if(Officer::where('user_id', $c->user->id)->exists()){
                                    Officer::where('user_id', $c->user->id)->delete();
                                }
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
         foreach($this->elections as $election) {
            if($election->officers()->where('is_elected', 1)->exists()) {
                $userCount = $election->userElections->count() / 2;
                if($election->userElections->where('has_voted', 1)->count() < (int)round($userCount)){
                    session()->flash('status', 'red');
                    session()->flash('message', $election->name . ' - has LESS THAN HALF the votes needed to proceed.');
                    return back();
                }
            }
        }
        $this->dispatchBrowserEvent('openConfModal');
    }
    public function render()
    {
        $this->elections = Election::all();
        $this->positions = Position::all();
        return view('livewire.new-election');
    }
}
