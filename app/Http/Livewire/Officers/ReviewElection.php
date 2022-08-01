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
        $positions = Position::withCount('candidates')->get();

        // Check if positions exists
        if ($positions->count() == 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'No candidates exists');

            $this->showConfirmModal = false;

            return;
        }

        // Check if each position has atleast two candidates
        foreach ($positions as $position) {
            if ($position->candidates_count < 2) {
                session()->flash('status', 'red');
                session()->flash('message', $position->name . ' position needs atleast two candidate to proceed');

                $this->showConfirmModal = false;

                return;
            }
        }

        // Change status of election
        $this->election->status = 'in progress';
        $this->election->save();

        return redirect('officers/elections/' . $this->election->id);
    }

    public function render()
    {
        return view('livewire.officers.review-election', [
            'positions' => Position::where('election_id', $this->election->id)->with(['candidates', 'candidates.user'])->paginate(5),
        ]);
    }
}
