<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use Livewire\Component;

class ReviewElection extends Component
{
    public Election $election;
    public $showConfirmModal = false;

    public function confirmSettings() {
        dd('start election');
    }

    public function render()
    {
        return view('livewire.officers.review-election', [
            'positions' => Position::where('election_id', $this->election->id)->with(['candidates', 'candidates.user'])->paginate(5),
        ]);
    }
}
