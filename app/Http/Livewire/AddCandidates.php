<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserSpecialization;
use Livewire\Component;
use Livewire\WithPagination;

class AddCandidates extends Component
{
    use WithPagination;

    public $search;
    public $bySchool = null;
    public $bySpecialization = null;
    public $byPosition;

    public function addCandidate($userId){  
        $this->validate(
           ['byPosition' => 'required'],
           ['byPosition.required' => 'Please choose a :attribute'],
           ['byPosition' => 'Position']
        );
        $user = User::find($userId);
        if(!Candidate::where('user_id', $userId)->exists()) {
            $user->candidate()->create([
                'position_id' => $this->byPosition,
                'specialization_id' => $user->userSpecialization->specialization->id,
                'ticap_id' => $user->ticap_id,
                'school_id' => $user->school->id,
            ]);
            $this->byPosition = "";
            $this->search = "";
            session()->flash('status', 'green');
            session()->flash('message', 'Student successfully added.');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Student already a candidate.');
        }
    }

    public function deleteCandidate($candidateId) {
        Candidate::where('user_id', $candidateId)->delete();
        session()->flash('status', 'green');
        session()->flash('message', 'Student successfully deleted.');
    }

    public function render()
    {   
        $schools = School::all();
        $specializations = Specialization::all();
        $positions = Position::all();
        return view('livewire.add-candidates', [
            'schools' => $schools,
            'specializations' => $specializations,
            'positions' => $positions,
            'candidates' => Candidate::with(['user', 'school', 'specialization', 'position'])->paginate(4),
            'users' => User::when($this->bySchool, function($query){
                $query->whereHas('userSpecialization', function($q){
                    $q->where('school_id', $this->bySchool);
                });
            })->when($this->bySpecialization, function($query){
                $query->whereHas('userSpecialization', function($q){
                    $q->where('specialization_id', $this->bySpecialization);
                });
            })
            ->search(trim($this->search))
            ->paginate(4),
        ]);
    }
}
