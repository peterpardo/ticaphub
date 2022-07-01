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

    public $isActive = 'users';
    public $showDeleteModal = false;

    public $selectedUser;

    protected $listeners = ['refreshParent'];

    public function refreshParent($action = null) {
        if ($action == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'User successfully added. An Invitation email will be sent user. This may take few minutes.');
        } else if ($action == 'update') {
            session()->flash('status', 'green');
            session()->flash('message', 'User successfully updated');
        }
    }

    public function selectItem($id) {
        $this->selectedUser = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal($modal) {
        if ($modal === 'delete') {
            $this->showDeleteModal = false;
        }
        $this->refreshParent();
    }

    public function editUser($id) {
        $this->emitTo('users.user-form', 'getUser', $id);
    }

    public function deleteItem() {
        $user = User::find($this->selectedUser);

        // Check if user still exists
        if (!$user) {
            session()->flash('status', 'red');
            session()->flash('message', 'User does not exist.');

            $this->showDeleteModal = false;

            return;
        }

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

        // Reset properties to default value
        $this->reset('selectedUser');

        // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'User successfully deleted');

        // Close Modal
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::orderBy('id')->paginate(5)
        ]);
    }
}
