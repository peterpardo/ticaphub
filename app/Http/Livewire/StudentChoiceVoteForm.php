<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\StudentChoiceVote;
use Livewire\Component;

class StudentChoiceVoteForm extends Component
{
    public $groupId;
    public $name;
    public $email;

    public function confirmVote() {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        // StudentChoiceVote::create([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'group_id' => $this->groupId
        // ]);
        $this->emit('confirmVote');
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.student-choice-vote-form', [
            'group' => Group::find($this->groupId),
        ]);
    }
}
