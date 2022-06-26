<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\User;
use App\Models\UserSpecialization;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $showDeleteModal = false;
    // public $showConfirmModal = false;

    public $selectedUser;

    protected $listeners = ['refreshParent'];

    public function refreshParent($action = null) {
        if ($action == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'User successfully added');
        } else if ($action == 'update') {
            session()->flash('status', 'green');
            session()->flash('message', 'User successfully updated');
        }
    }

    public function selectItem($id) {
        $this->selectedUser = $id;
    }

    public function editUser($id) {
        $this->emitTo('users.add-user-form', 'getUser', $id);
        $this->showAddModal = true;
    }

    public function deleteItem() {
        $user = User::find($this->selectedUser);

        // Invalidate registration link sent to the user if it's still not verified
        DB::table('register_users')->where('email', $user->email)->delete();

        // Remove role/s to the user model
        $user->syncRoles([]);

        // Check if the deleted user is a student
        // if ($user->hasRole('student')) {
        //     Get group of the student
        //     $group = Group::find($user->userGroup->group->id);
        //     $memberCount = UserSpecialization::where('group_id', $user->userSpecialization->group_id)->count();

        //     Delete group if there are no members left
        //     if ($memberCount == 0) {
        //         // $group->delete();
        //         Group::destroy($user->userSpecialization->group_id);
        //     }
        // }

        // Delete user
        $user->delete();

        // // Reset properties to default value
        $this->reset(['selectedUser']);

        // // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'User successfully deleted');
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::orderBy('id')->paginate(5)
        ]);
    }
}
