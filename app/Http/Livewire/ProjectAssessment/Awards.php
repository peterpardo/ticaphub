<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Award;
use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class Awards extends Component
{
    use WithPagination;

    public Specialization $specialization;

    protected $listeners = ['refreshParent'];

    public function refreshParent($type) {
        if ($type == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Award has been successfully created');
        } else {
            session()->flash('status', 'green');
            session()->flash('message', 'Award has been successfully updated');
        }
    }


    public function render()
    {
        return view('livewire.project-assessment.awards', [
            'awards' => Award::where('specialization_id', $this->specialization->id)->with('rubric:id,name')->paginate(5),
        ]);
    }
}
