<?php

namespace App\Http\Livewire;

use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;

class SpecializationForm extends Component
{
    public $involvedSchools;
    public $selectedSchool;
    public $specId;
    public $specialization;
    protected $listeners = [
        'getSpecId',
        'closeSpecForm'
    ];
    protected $rules = [
        'selectedSchool' => 'required',
        'specialization' => 'required',
    ];
    protected $messages = [
        'selectedSchool.required' => 'School is required',
        'specialization.required' => 'Specialization is required',
    ];

    public function updateSpec() {
        $this->validate();
        Specialization::find($this->specId)->update([
            'name' => $this->specialization,
            'school_id' => $this->selectedSchool,
        ]);
        $this->emit('specUpdated');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function closeSpecForm() {
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function getSpecId($specId) {
        $this->specId = $specId;
        $spec = Specialization::find($specId);
        $this->specialization = $spec->name;
        $this->selectedSchool = $spec->school->id;
    }
    public function render()
    {
        $this->involvedSchools = School::where('is_involved', 1)->get();
        return view('livewire.specialization-form');
    }
}
