<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $showDeleteModal = false;
    // public $showConfirmModal = false;
    public $showAddModal = false;

    protected $listeners = ['refreshParent'];

    public function refreshParent($status = null) {
        if ($status === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');
        }

        $this->showAddModal = false;
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::orderBy('id')->paginate(5)
        ]);
    }
}
