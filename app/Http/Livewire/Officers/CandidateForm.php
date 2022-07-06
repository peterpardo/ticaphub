<?php

namespace App\Http\Livewire\Officers;

use App\Models\Position;
use App\Models\User;
use Livewire\Component;

class CandidateForm extends Component
{
    public $electionId;
    public $name = 'Student name';
    public $search = '';
    public $showModal = false;
    public $selectedPositionId = '';
    public $selectedStudentId;
    public $action = 'add';

    protected $listeners = ['showModal', 'getPosition'];

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;

        $this->reset('name', 'showModal', 'action', 'selectedPositionId', 'search', 'name');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.officers.candidate-form', [
            'students' => User::whereHas('userElection', function ($query) {
                $query->where('election_id', $this->electionId);
            })
            ->search($this->search)
            ->orderBy('id')
            ->get(),
            'positions' => Position::where('election_id', $this->electionId)->get(),
        ]);
    }
}
