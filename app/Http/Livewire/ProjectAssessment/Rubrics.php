<?php

namespace App\Http\Livewire\ProjectAssessment;

use App\Models\Rubric;
use Livewire\Component;

class Rubrics extends Component
{
    public $showDeleteModal = false;
    public $selectedRubric;

    protected $listeners = ['refreshParent'];

    public function refreshParent($type) {
        if ($type == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Rubric has been successfully created');
        } else {
            session()->flash('status', 'green');
            session()->flash('message', 'Rubric has been successfully updated');
        }
    }

    public function selectItem($id) {
        $this->selectedRubric = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->reset('showDeleteModal', 'selectedRubric');
    }

    public function deleteItem() {
        if (Rubric::destroy($this->selectedRubric) > 0) {
            session()->flash('status', 'green');
            session()->flash('message', 'Rubric has been successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Please try again.');
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.project-assessment.rubrics', [
            'rubrics' => Rubric::withCount('criteria')->get(),
        ]);
    }
}
