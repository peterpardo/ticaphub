<?php

namespace App\Http\Livewire;

use App\Models\Adviser;
use App\Models\Election;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Settings extends Component
{
    public $isActive = 'settings';
    public $showModal = false;
    public Ticap $ticap;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'TICaP name successfully updated.');
        }
    }

    public function endEvent() {
        $superadmin = User::find(auth()->user()->id);

        // Delete users
        $this->deleteUsers();

        // Set current ticap to done
        $this->ticap->is_done = true;
        $this->ticap->save();

        // Set ticap_id of superadmin to null
        $superadmin->ticap_id = null;
        $superadmin->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Congratulations! TICaP has been successfully ended.');

        return redirect()->route('dashboard');
    }

    public function deleteUsers() {
        // Delete all users (except superadmin)
        User::where('id', '!=', auth()->user()->id)->delete();

        // Delete all roles (except superadmin)
        DB::table('model_has_roles')->where('model_id', '!=', auth()->user()->id)->delete();

        // Delete all permissions for all users
        DB::table('model_has_permissions')->truncate();

        // Delete all unregistered emails
        DB::table('register_users')->truncate();

        // Delete all groups
        DB::table('groups')->delete();

        // Delete all advisers
        DB::table('advisers')->delete();

        // Delete all specializations
        DB::table('specializations')->delete();

        // Delete all elections
        DB::table('elections')->delete();

        // Reset schools
        School::where('id', '!=' , 1)->update(['is_involved' => 0]);
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
