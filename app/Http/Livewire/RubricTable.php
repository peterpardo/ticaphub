<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;

class RubricTable extends Component
{
    public $selectedSchool = null;
    public $selectedSpec = null;
    public $specializations;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
   
    public function selectAward($awardId) {
        $this->emit('getAwardId', $awardId);
        $this->dispatchBrowserEvent('openRubricModal');
    }
    public function updatedSelectedSchool($schoolId) {
        $this->selectedSpec = null;
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }
    public function render()
    {   
        return view('livewire.rubric-table', [
            'awards' => Award::when($this->selectedSpec, function($query){
                $query->where('specialization_id', $this->selectedSpec);
            })
            ->when($this->selectedSchool, function($query){
                $query->where('school_id', $this->selectedSchool);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(6),
            'schools' => School::where('is_involved', 1)->get(),
        ]);
    }
}
