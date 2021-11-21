<?php

namespace App\Http\Livewire;

use App\Models\Election;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class SchoolTable extends Component
{
    public $involvedSchools;
    public $selectedSchool;
    public $specialization;
    public $specs;
    public $selectedSpec;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
    protected $rules = [
        'selectedSchool' => 'required',
        'specialization' => 'required',
    ];
    protected $messages = [
        'selectedSchool.required' => 'School is required',
        'specialization.required' => 'Specialization is required',
    ];
    
    public function setInvitation() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        // CREATE ELECTIONS
        $schools = School::where('is_involved', 1)->get();
        foreach($schools as $school) {
            if($school->specializations->count() < 1) {
                session()->flash('status', 'red');
                session()->flash('message', $school->name . ' has no specializaions created');
                return back();
            }
            if($school->id == 1){
                // CREATE ELECTIONS PER SPECIALIZATION FOR FEU TECH
                foreach($school->specializations as $spec) {
                    $spec->election()->create([
                        'name' => $school->name . ' | ' . $spec->name,
                        'ticap_id' => $ticap->id
                    ]);
                }
            } else {
                // CREATE ONE ELECTION ONLY FOR FEU DILIMAN AND FEU ALABANG
                Election::create([
                    'name' => $school->name,
                    'ticap_id' => $ticap->id
                ]);
            }
        }
        
        // CREATE DEFUALT AWARDS
        foreach(Specialization::all() as $spec) {
            // BEST CAPSTONE PROJECT AWARD
            $spec->awards()->create([
                'name' => 'Best Capstone Project',
                'type' => 'group',
                'school_id' => $spec->school->id,
                'ticap_id' => $ticap->id,
            ]);
            // BEST GROUP PRESENTER
            $spec->awards()->create([
                'name' => 'Best Group Presenter',
                'type' => 'individual',
                'school_id' => $spec->school->id,
                'ticap_id' => $ticap->id,
            ]); 
        }

        // SET INVITATION
        $ticap->invitation_is_set = 1;
        $ticap->save();
        return redirect()->route('users');
    }
    public function closeConfirmationModal() {
        $this->dispatchBrowserEvent('closeConfModal');
    }
    public function openConfirmationModal() {
        $this->dispatchBrowserEvent('openConfModal');
    }
    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function deleteSpec() {
        Specialization::find($this->selectedSpec)->delete();
        $this->emit('specDeleted');
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function selectSpec($specId, $action) {
        if($action == 'update') {
            $this->emit('getSpecId', $specId);
            $this->dispatchBrowserEvent('openUpdateModal');
        } else {
            $this->selectedSpec = $specId;
            $this->dispatchBrowserEvent('openDeleteModal');
        }
    }
    public function addSpecialization() {
        $this->validate();
        $school = School::find($this->selectedSchool);
        $spec = trim(Str::title($this->specialization));
        if($school->specializations()->where('name', $spec)->exists()) {
            session()->flash('status', 'red');
            session()->flash('message', 'Specialization already exists');
            return back();
        }

        $school->specializations()->create([
            'name' => $spec
        ]);

        session()->flash('status', 'green');
        session()->flash('message', 'Specialization successfully added');
        $this->reset();
    }
    public function removeSchool($id) {
        Specialization::where('school_id', $id)->delete();
        School::find($id)->update(['is_involved' => 0]);
    }
    public function addSchool($id) {
        School::find($id)->update(['is_involved' => 1]);
    }
    public function render()
    {
        $schools = School::all();
        $this->involvedSchools = School::where('is_involved', 1)->get();
        $this->specs = Specialization::whereHas('school', function($q){
            $q->where('is_involved', 1);
        })->get();
        return view('livewire.school-table', [
            'schools' => $schools
        ]);
    }
}
