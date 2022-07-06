<?php

namespace App\Http\Livewire\Officers;

use App\Models\Position;
use Livewire\Component;

class PositionForm extends Component
{
    public $electionId;
    public $name = '';
    public $showModal = false;
    public $selectedPositionId;
    public $action = 'add';

    protected $rules = [
        'name' => 'required|string|max:20'
    ];

    protected $listeners = ['showModal', 'getPosition'];

    public function getPosition($id) {
        $position = Position::where('id', $id)->first();
        $this->selectedPositionId = $position->id;
        $this->name = $position->name;

        $this->action = 'edit';
        $this->showModal();
    }

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;

        $this->reset('name', 'showModal', 'action');
        $this->resetValidation();
    }

    public function updatedName() {
        $this->emitUp('refreshParent');
    }

    public function addPosition() {
        $this->validate();

        $isNameExists = Position::where('election_id', $this->electionId)
            ->where('name', strtolower(trim($this->name)))->exists();

        // Return error message if name is not unique
        if ($isNameExists) {
            $this->addError('name', 'The name must be unique.');
            return;
        }

        // Add position
        $isSuccess = null;
        if ($this->action === 'add') {
            $isSuccess = Position::create([
                'name' => trim($this->name),
                'election_id' => $this->electionId
            ]);
        } else {
            $isSuccess = Position::where('id', $this->selectedPositionId)
                ->update(['name' => trim($this->name)]);
        }

        // Check if add/edit position is success
        if ($isSuccess === 0 || is_null($isSuccess)) {
            $this->emit('refreshParent', 'error');
        } else {
            // Refresh parent component and return success message
            $this->emit('refreshParent', $this->action);
        }

        // Close modal
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.officers.position-form');
    }
}
