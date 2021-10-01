<?php

namespace App\Http\Livewire;

use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AddMember extends Component
{
    use WithPagination;

    public Committee $committee;
    public $search;
    public $selectedSchool;
    public $selectedSpec;

    public function deleteMember($userId) {
        if(!$this->committee->committeeMembers()->where('user_id', $userId)->exists()) {
            session()->flash('status', 'red');
            session()->flash('message', 'Member already deleted.');
        } else {
            $this->committee->committeeMembers()->where('user_id', $userId)->delete();
            session()->flash('status', 'green');
            session()->flash('message', 'Student successfully deleted.');
        }
    }
    public function addMember($userId) {
        $user = User::find($userId);
        if($user->hasAnyRole('officer', 'chairman')) {
            session()->flash('status', 'red');
            session()->flash('message', 'Student already an officer.');
        } elseif($this->committee->committeeMembers()->where('user_id', $userId)->exists()) {
            session()->flash('status', 'red');
            session()->flash('message', 'Student already a member.');
        } else {
            $this->committee->committeeMembers()->create([
                'user_id' => $userId
            ]);
            session()->flash('status', 'green');
            session()->flash('message', 'Student successfully added.');
        }
    }
    public function render()
    {
        return view('livewire.add-member', [
            'users' => User::role('student')->when($this->selectedSpec, function($query){
                $query->whereHas('userSpecialization', function($q){
                    $q->where('specialization_id', $this->selectedSpec);
                });
            })
            ->search(trim($this->search))
            ->paginate(4),
            'schools' => School::where('is_involved', 1)->get(),
            'specializations' => Specialization::all(),
            'members' => CommitteeMember::where('committee_id', $this->committee->id)->get()
        ]);
    }
}
