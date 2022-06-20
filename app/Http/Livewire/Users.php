<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    // public $showDeleteModal = false;
    // public $showConfirmModal = false;
    // public $showFormModal = false;

    protected $listeners = ['refreshParent'];

    public function refreshParent($status = null) {
        if ($status === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');
        }

        // $this->showFormModal = false;
    }

    // Open modal
    public function openModal($action) {
        if ($action === 'delete') {
            $this->showDeleteModal = true;
        } else if ($action === 'add') {
            $this->showFormModal = true;
        } else {
            $this->showConfirmModal = true;
        }
    }

    // Close modal
    public function closeModal($action) {
        if ($action === 'delete') {
            $this->showDeleteModal = false;
        }  else if ($action === 'add') {
            $this->showFormModal = false;
        } else {
            $this->showConfirmModal = false;
        }
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::paginate(5)
        ]);
    }
}
