<?php

namespace App\Http\Livewire\Officers;

use App\Exceptions\GeneralException;
use App\Models\Election;
use App\Models\Position;
use App\Models\UserElection;
use App\Models\Vote as ModelsVote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Vote extends Component
{
    public Election $election;
    public $positions;
    public $showConfirmModal = false;
    public $positionProps = [];

    public function mount() {
        $this->positions = Position::where('election_id', $this->election->id)->with(['candidates', 'candidates.user'])->get();

        // Create properties for each position
        $positionProps = [];
        foreach ($this->positions as $position) {
            $positionProps[$position->position_slug] = '';
        }

        $this->positionProps = $positionProps;
    }

    public function submitVote() {
        // If the election is already in review, don't count the vote and redirect to election page
        if ($this->election->in_review) {
            session()->flash('status', 'red');
            session()->flash('message', 'Sorry, your vote didn\'t count. The voting of officers is already finished.');

            // Redirect to election page
            return redirect('/officers/elections/' . $this->election->id);
        }

        // Create validation rules
        $customRules = [];
        $customAttributes = [];
        foreach ($this->positionProps as $key => $value) {
            $customRules['positionProps.' . $key] = 'required|numeric';

            // Replace '_" in position names with space
            $newAttributeName = str_replace('_', ' ', $key);
            $customAttributes['positionProps.' . $key] = $newAttributeName;
        }

        // Validate votes
        $validator = Validator::make(
            ['positionProps' => $this->positionProps],
            $customRules,
            [],
            $customAttributes);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $hasError = false;

            foreach ($customRules as $rule => $value) {
                // Check if there are errors
                if ($errors->has($rule)) {
                    session()->flash('status', 'red');
                    session()->flash('message', $errors->first($rule));
                    $hasError  = true;

                    break;
                }
            }

            $this->showConfirmModal = false;

            // Show error message
            if ($hasError) return;
        }

        // Add votes of student
        foreach ($this->positionProps as $candidateId) {
            ModelsVote::create([
                'user_id' => auth()->user()->id,
                'candidate_id' => $candidateId,
                'election_id' => $this->election->id
            ]);
        }

        // Set student to 'has_voted'
        UserElection::where('user_id', auth()->user()->id)->update(['has_voted' => 1]);

        session()->flash('status', 'green');
        session()->flash('message', 'Your vote has been successfully saved. Awesome!');

        // Redirect to election page
        return redirect('/officers/elections/' . $this->election->id);
    }

    public function render()
    {
        return view('livewire.officers.vote');
    }
}
