<?php

namespace App\Http\Livewire;

use App\Models\Election;
use App\Models\Officer;
use App\Models\Position;
use App\Models\Ticap;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ElectionReview extends Component
{
    public $elections;

    public function endElection() {
        // SET ELECTION FINISHED FOR THE TICAP
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $ticap->election_finished = 1;
        $ticap->has_new_election = 0;
        $ticap->election_review = 0;
        $ticap->save();
        // ASSIGNMENT OF ROLES TO ELECTED OFFICERS
        $officers = Officer::all();
        foreach($officers as $officer) {
            if($officer->position->name == 'Chairman'){
                $officer->user->assignRole('chairman');
            } else {
                $officer->user->assignRole('officer');
            }
        }
        return redirect()->route('officers');
    }
    public function startNewElection() {
        foreach($this->elections as $election) {
            if($election->officers()->where('is_elected', 0)->exists()){
                foreach($election->officers->where('is_elected', 0) as $officer) {
                    Vote::where('candidate_id', $officer->user->candidate->id)->delete();
                }
                $election->userElections()->update(['has_voted' => 0]);
            }
        }
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $ticap->election_review = 0;
        $ticap->has_new_election = 1;
        $ticap->save();
        return redirect()->route('new-election');
    }
    public function closeNewElectionModal() {
        $this->dispatchBrowserEvent('closeNewElectionModal');
    }
    public function closeConfirmationModal() {
        $this->dispatchBrowserEvent('closeConfModal');
    }
    public function confirmElection($action) {
        if($action == 'redo') {
            $this->dispatchBrowserEvent('openNewElectionModal');
        } else {
            $this->dispatchBrowserEvent('openConfModal');
        }
    }
    public function render()
    {
        $this->elections = Election::all();
        $positions = Position::all();
        return view('livewire.election-review', [
            'positions' => $positions,
        ]);
    }
}
