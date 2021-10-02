<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Rubric;
use Livewire\Component;

class SetRubricForm extends Component
{
    public $selectedRubric;
    public $awardName;
    public $awardId;
    protected $listeners = [
        'getAwardId',
        'closeRubricModal'
    ];
    protected $rules = [
        'selectedRubric' => 'required'
    ];
    protected $messages = [
        'selectedRubric.required' => 'Please select a rubric for this award'
    ];

    public function setRubric() {
        $this->validate();
        $award = Award::find($this->awardId);
        if($award->awardRubric()->exists()) {
            $award->awardRubric->rubric_id = $this->selectedRubric;
            $award->awardRubric->save();
        } else {
            $award->awardRubric()->create([
                'rubric_id' => $this->selectedRubric
            ]);
        }
        $this->emit('rubricAssigned');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeRubricModal');
    }
    public function closeRubricModal() {
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeRubricModal');
    }
    public function getAwardId($awardId) {
        $this->awardId = $awardId;
        $award = Award::find($awardId);
        $this->awardName = $award->name;
        if($award->awardRubric()->exists()) {
            $this->selectedRubric = $award->awardRubric->rubric->id;
        }
    }
    public function render()
    {   
        $rubrics = Rubric::all();
        return view('livewire.set-rubric-form', [
            'rubrics' => $rubrics,
            'criteria' => Criteria::when($this->selectedRubric, function($q) {
                $q->where('rubric_id', $this->selectedRubric);
            })->get()
        ]);
    }
}
