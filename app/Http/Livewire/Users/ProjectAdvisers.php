<?php

namespace App\Http\Livewire\Users;

use App\Models\Adviser;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectAdvisers extends Component
{
    use WithPagination;

    public $isActive = 'advisers';
    public $showDeleteModal = false;
    public $selectedAdviser;
    public $search = '';

    protected $listeners = ['refreshParent'];

    public function refreshParent($action = null) {
        if ($action == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Adviser successfully added');
        } else if ($action == 'update') {
            session()->flash('status', 'green');
            session()->flash('message', 'Adviser successfully updated');
        }
    }

    public function selectItem($id) {
        $this->selectedAdviser = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->showDeleteModal = false;
    }

    public function deleteItem() {
        $deletedAdviser = Adviser::destroy($this->selectedAdviser);

        // Check if the group is successfully deleted
        if ($deletedAdviser >= 1) {
            session()->flash('status', 'green');
            session()->flash('message', 'Adviser successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Try reloading the page.');
        }

        // Reset properties to default value
        $this->reset('selectedAdviser');

        // Close Modal
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.users.project-advisers', [
            'advisers' => Adviser::search($this->search)->paginate(5),
        ]);
    }
}
