<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\Election;
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
    public $selectedSchool;
    public $selectedSpec;
    public $selectedElection;
    public $specializations;
    public $selectedPosition;

    public function startElection() {
        return redirect()->route('election');
    }
    public function closeConfirmationModal() {
        $this->dispatchBrowserEvent('closeConfModal');
    }
    public function confirmCandidates() {
        // CHECK IF ALL POSITIONS FOR EACH ELECTION HAVE CANDIDATES
        $elections = Election::all();
        $positions = Position::all();
        foreach($elections as $election) {
            foreach($positions as $position) {
                if($election->candidates->where('position_id', $position->id)->count() < 2) {
                    echo $election->id . '<br>';
                    dd($election->candidates);
                    // dd($election->candidates->where('position_id', $position->id)->count());
                    session()->flash('status', 'red');
                    session()->flash('message', $election->name . ' - not enough candidates for position (' . $position->name . ')');
                    return back();
                }
            }
        }
        $this->dispatchBrowserEvent('openConfModal');
    }
    public function updatedSelectedSchool($id) {
        $this->selectedSpec = null;
        $this->specializations = Specialization::where('school_id', $id)->get();
    }
    public function addCandidate($userId){  
        $this->validate(
           ['selectedPosition' => 'required'],
           ['selectedPosition.required' => 'Please choose a :attribute'],
           ['selectedPosition' => 'Position']
        );
        $user = User::find($userId);
        // CHECK IF USER IS ALREADY A CANDIDATE
        if(!Candidate::where('user_id', $userId)->exists()) {
            // IF STUDENT IS FEU TECH
            if($user->userSpecialization->specialization->school->id == 1) {
                $spec = Specialization::find($user->userSpecialization->specialization->id);
                $spec->election->candidates()->create([
                    'user_id' => $user->id,
                    'position_id' => $this->selectedPosition,
                ]);
            } else {
                if($user->userSpecialization->specialization->school->name == 'FEU DILIMAN') {
                    $election = Election::with(['candidates'])->where('name', 'FEU DILIMAN')->first();
                    $election->candidates()->create([
                        'user_id' => $user->id,
                        'position_id' => $this->selectedPosition,
                    ]);
                } elseif($user->userSpecialization->specialization->school->name == 'FEU ALABANG') {
                    $election = Election::with(['candidates'])->where('name', 'FEU DILIMAN')->first();
                    $election->candidates()->create([
                        'user_id' => $user->id,
                        'position_id' => $this->selectedPosition,
                    ]);
                }
            }
            $this->search = "";
            session()->flash('status', 'green');
            session()->flash('message', 'Student successfully added.');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Student already a candidate.');
        }
    }
    public function deleteCandidate($candidateId) {
        Candidate::where('id', $candidateId)->delete();
        session()->flash('status', 'red');
        session()->flash('message', 'Candidate successfully deleted.');
    }
    public function render()
    {   
        $specializations = Specialization::all();
        $positions = Position::all();
        return view('livewire.add-candidates', [
            'schools' => School::where('is_involved', 1)->get(),
            'candidates' => Candidate::when($this->selectedElection, function($q) {
                $q->where('election_id', $this->selectedElection);
            })->get(),
            'elections' => Election::all(),
            'specializations' => $specializations,
            'positions' => $positions,
            'users' => User::role('student')->when($this->selectedSpec, function($query){
                $query->whereHas('userSpecialization', function($q){
                    $q->where('specialization_id', $this->selectedSpec);
                });
            })
            ->where('email_verified', 1)
            ->search(trim($this->search))
            ->paginate(4),
        ]);
    }
}
