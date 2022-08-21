<?php

namespace App\Http\Livewire\GradeGroups;

use App\Models\Award;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use Livewire\Component;

class ViewAwards extends Component
{
    public $specializationId;
    public SpecializationPanelist $panelist;
    public $isDone;

    public function mount() {
        $this->panelist = SpecializationPanelist::where('user_id', auth()->user()->id)->first();
        $this->isDone = $this->panelist->is_done;
    }

    public function updatedIsDone($value) {
        $this->panelist->is_done = $value;
        $this->panelist->save();

        session()->flash('status', 'green');
        if ($value) {
            session()->flash('message', 'Marked as done grading.');
        } else {
            session()->flash('message', 'Marked as not yet done grading.');
        }
    }

    public function render()
    {
        return view('livewire.grade-groups.view-awards', [
            'awards' => Award::where('specialization_id', $this->specializationId)->get(),
            'specialization' => Specialization::with('school:id,name')->find($this->specializationId),
            'panelists' => SpecializationPanelist::where('specialization_id', $this->specializationId)->get(),
        ]);
    }
}
