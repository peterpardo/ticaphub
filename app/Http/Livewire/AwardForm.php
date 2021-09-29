<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\School;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class AwardForm extends Component
{
    public $selectedSchool = null;
    public $selectedSpec;
    public $name;
    public $type;
    public $awardId;
    public $specializations; 
    protected $listeners = [
        'closeAwardForm',
        'getAwardId'
    ];
    protected $rules = [
        'name' => 'required',
        'type' => 'required',
        'selectedSchool' => 'required',
        'selectedSpec' => 'required',
    ];
    protected $messages = [
        'name.required' => 'The Award Name is required.',
        'type.required' => 'The Award Type s required.',
        'selectedSchool.required' => 'The School is required.',
        'selectedSpec.required' => 'The Specialization is required.',
    ];

    public function updatedSelectedSchool($schoolId) {
        $this->selectedSpec = null;
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }
    public function getAwardId($awardId) {
        $this->awardId = $awardId;
        $award = Award::find($awardId);
        $this->name = $award->name;
        $this->type = $award->type;
        $this->selectedSchool = $award->school->id;
        $this->selectedSpec = $award->specialization->id;
    }
    public function closeAwardForm(){
        $this->reset(['name', 'type', 'selectedSchool', 'selectedSpec']);
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeModal');
    }
    public function addAward() {
        $this->validate();
        $ticap = Auth::user()->ticap_id;
        $data = [
            'name' => Str::title($this->name),
            'type' => $this->type,
            'school_id' => $this->selectedSchool,
            'specialization_id' => $this->selectedSpec,
            'ticap_id' => $ticap,
        ];
        if($this->awardId) {
            Award::find($this->awardId)->update($data);
        } else {
            Award::create($data);
        }
        $this->reset(['name', 'type', 'selectedSchool', 'selectedSpec']);
        $this->emit('awardAdded');
        $this->emit('refreshParent');
    }
    public function render()
    {
        $schools = School::where('is_involved', 1)->get();
        return view('livewire.award-form', [
            'schools' => $schools,
        ]);
    }
}
