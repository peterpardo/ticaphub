<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class AwardTable extends Component
{
    use WithPagination; 

    public $selectedAward;
    public $selectedSchool = null;
    public $selectedSpec = null;
    public $specializations;
    public $selectedType;
    public $search;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
   
    public function updatedSelectedSchool($schoolId) {
        $this->selectedSpec = null;
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }
    public function openDeleteModal($awardId) {
        $this->selectedAward = $awardId;
        $this->dispatchBrowserEvent('openDeleteModal');
    }
    public function deleteAward() {
        Award::find($this->selectedAward)->delete();
        $this->emit('awardDeleted');
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
    public function addAwardForm() {
        $this->dispatchBrowserEvent('openModal');
    }
    public function editAward($awardId) {
        $this->emit('getAwardId', $awardId);
        $this->dispatchBrowserEvent('openModal');
    }
    public function render()
    {   
        $search = trim($this->search);
        return view('livewire.award-table', [
            'awards' => Award::where('name', 'like', "%$search%")
            ->when($this->selectedSpec, function($query){
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
