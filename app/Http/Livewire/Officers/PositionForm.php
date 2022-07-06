<?php

namespace App\Http\Livewire\Officers;

use App\Models\Position;
use Livewire\Component;

class PositionForm extends Component
{
    public $electionId;
    public $name = '';
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:20'
    ];

    protected $listeners = ['showModal'];

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;

        $this->reset('name', 'showModal');
        $this->resetValidation();
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
        Position::create([
            'name' => trim($this->name),
            'election_id' => $this->electionId
        ]);

        // Refresh parent component and return success message
        $this->emit('refreshParent', 'success');

        // Close modal
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.officers.position-form');
    }
}
