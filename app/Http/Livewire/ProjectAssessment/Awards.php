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
    public $showDeleteModal;
    public $selectedAward;

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

    public function closeModal() {
        $this->reset('showDeleteModal', 'selectedAward');
    }

    public function selectItem($id) {
        $this->selectedAward = $id;
        $this->showDeleteModal = true;
    }

    public function deleteItem() {
        if (Award::destroy($this->selectedAward) > 0) {
            session()->flash('status', 'green');
            session()->flash('message', 'Award has been successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Please try again.');
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.awards', [
            'awards' => Award::where('specialization_id', $this->specialization->id)->with('rubric:id,name')->paginate(5),
        ]);
    }
}
