<?php

namespace App\Http\Livewire\Officers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use Livewire\Component;

class CandidateForm extends Component
{
    public $electionId;
    public $name = '';
    public $search = '';
    public $showModal = false;
    public $selectedPositionId = '';
    public $selectedStudentId;
    public $candidateId;
    public $action = 'add';

    protected $rules = [
        'selectedStudentId' => 'required|numeric',
        'selectedPositionId' => 'required|numeric'
    ];

    protected $validationAttributes = [
        'selectedStudentId' => 'student',
        'selectedPositionId' => 'position',
    ];

    protected $listeners = ['showModal', 'getCandidate'];


    public function getCandidate($id) {
        $candidate = Candidate::where('id', $id)->first();
        $student = User::where('id', $candidate->user_id)->first();
        $this->name = $student->fullname;
        $this->selectedStudentId = $candidate->user_id;
        $this->selectedPositionId = $candidate->position_id;
        $this->candidateId = $candidate->id;

        $this->action = 'edit';
        $this->showModal();
    }

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;

        $this->reset('name', 'showModal', 'action', 'selectedPositionId', 'search', 'name', 'selectedStudentId');
        $this->resetValidation();
    }

    public function selectStudent($id, $studentName) {
        $this->selectedStudentId = $id;
        $this->name = $studentName;
        $this->reset('search');
    }

    public function updatedSearch() {
        $this->emitUp('refreshParent');
    }

    public function updatedSelectedPositionId() {
        $this->emitUp('refreshParent');
    }

    public function saveCandidate() {
        $this->validate();

        // Check if student is candidate
        $isCandidate = Candidate::where('user_id', $this->selectedStudentId)->exists();
        if ($isCandidate) {
            $this->addError('selectedStudentId', 'This student is already a candidate');
            return;
        }

        // Check if student exists
        $studentExists = User::where('id', $this->selectedStudentId)->exists();

        // Check if position exists
        $positionExists = Position::where('id', $this->selectedPositionId)->exists();

        // Add/Edit candidate
        $isSuccess = null;
        if ($studentExists && $positionExists) {
            if ($this->action === 'add') {
                $isSuccess = Candidate::create([
                    'user_id' => $this->selectedStudentId,
                    'position_id' => $this->selectedPositionId,
                    'election_id' => $this->electionId,
                ]);
            } else {
                $isSuccess = Candidate::where('id', $this->candidateId)
                    ->update([
                        'user_id' => $this->selectedStudentId,
                        'position_id' => $this->selectedPositionId,
                    ]);
            }
        }

        // Check if add/edit candidate is success
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
