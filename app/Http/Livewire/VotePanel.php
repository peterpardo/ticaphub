<?php

namespace App\Http\Livewire;

use App\Models\Election;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VotePanel extends Component
{
    public $election;
    public $positions;
   
    public function submitVote() {
        dd('sent');
    }
    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->positions = Position::all();
        $this->election = Election::where('specialization_id', $user->userSpecialization->specialization->id)->first();
        return view('livewire.vote-panel');
    }
}
