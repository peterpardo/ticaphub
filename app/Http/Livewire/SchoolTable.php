<?php

namespace App\Http\Livewire;

use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
        Ticap::find(Auth::user()->ticap_id)->update(['invitation_is_set' => 1]);
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
        $school->specializations()->create([
            'name' => $this->specialization
        ]);
        session()->flash('status', 'green');
        session()->flash('message', 'Specialization successfully added');
        $this->reset();
    }
    public function removeSchool($id) {
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
