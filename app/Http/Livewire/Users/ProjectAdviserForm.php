<?php

namespace App\Http\Livewire\Users;

use App\Models\Adviser;
use Livewire\Component;

class ProjectAdviserForm extends Component
{
    public $showForm = false;
    public $action = 'add';
    public $selectedAdviser; // selected adviser to be updated

    public $adviser = '';

    protected $rules = [
        'adviser' => 'required|max:50|unique:advisers,name'
    ];

    protected $listeners = ['showForm', 'getAdviser'];

    public function getAdviser($id) {
        $this->selectedAdviser = Adviser::find($id);
        $this->adviser = $this->selectedAdviser->name;

        // Set action as update
        $this->action = 'update';
        $this->showForm = true;
    }

    public function showForm() {
        $this->showForm = true;
        $this->emitUp('refreshParent');
    }

    public function closeModal() {
        $this->showForm = false;
        $this->resetValidation();
        $this->reset('adviser', 'action');
    }

    public function addAdviser() {
        $this->validate();

        // Check action if "add" or "update"
        if ($this->action === 'add') {
            // Create adviser
            Adviser::create([
                'name' => $this->adviser
            ]);
        } else {
            $adviser = Adviser::find($this->selectedAdviser->id);

            // If adviser exists, update adviser name
            if ($adviser) {
                $adviser->name = $this->adviser;
                $adviser->save();
            }
        }

        // Refresh parent component and return success message
        $this->emit('refreshParent', $this->action);

        // Hide modal
        $this->showForm = false;

        // Reset input fields
        $this->reset('adviser', 'action');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.users.project-adviser-form');
    }

}
