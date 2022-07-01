<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Groups extends Component
{
    use WithPagination;

    public $isActive = 'groups';
    public $showDeleteModal = false;
    public $selectedGroup;
    public $search = '';

    protected $listeners = ['refreshParent'];

    public function refreshParent($action = null) {
        if ($action == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Group successfully added');
        } else if ($action == 'update') {
            session()->flash('status', 'green');
            session()->flash('message', 'Group successfully updated');
        }
    }

    public function selectItem($id) {
        $this->selectedGroup = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->showDeleteModal = false;
    }

    public function deleteItem() {
        $deletedGroup = Group::destroy($this->selectedGroup);

        // Check if the group is successfully deleted
        if ($deletedGroup >= 1) {
            session()->flash('status', 'green');
            session()->flash('message', 'Group successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Try reloading the page.');
        }

        // Reset properties to default value
        $this->reset('selectedGroup');

        // Close Modal
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.users.groups', [
            'groups' => Group::select('id', 'name', 'specialization_id', 'adviser_id')->search($this->search)->withCount('userSpecializations')->with(['adviser', 'specialization', 'specialization.school'])->paginate(5)
        ]);
    }
}
