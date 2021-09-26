<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserTable extends Component
{       
    public $search;
    public $selectedUser;

    public function selectUser($userId){
        $this->selectedUser = $userId;
        $this->dispatchBrowserEvent('openModal');
    }
    public function deleteUser(){
        $user = User::find($this->selectedUser);
        // INVALIDATE REGISTRATION LINK SENT TO USER IF STILL NOT VERIFIED
        DB::table('register_users')->where('email', $user->email)->delete();
        $user->delete();
        $this->emit('userDeleted');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function closeModal(){
        $this->dispatchBrowserEvent('closeModal');
    }
    public function resetUserBtn() {
        $this->dispatchBrowserEvent('openResetModal');
    }
    public function resetUsers() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        // ARCHIVE EVENTS AND EVENT FILES
        foreach($ticap->events as $event) {
            $archivedEvent = $ticap->archivedEvents()->create([
                'name' => $event->name
            ]);
            foreach($event->files as $file) {
                $archivedEvent->archivedFiles()->create([
                    'name' => $file->name,
                    'path' => $file->path,
                ]);
            }
        }
        // DELETE ALL STUDENTS
        User::role('student')->delete();
        // DELETE REGISTER_USERS TABLE
        DB::table('register_users')->truncate();
        // DELETE ALL ADDED EVENTS
        Event::where('id', '!=', 1)
        ->where('id', '!=', 2)
        ->where('id', '!=', 3)
        ->delete();
        // RESET TICAP
        User::find(Auth::user()->id)->update(['ticap_id' => null]);
        $this->dispatchBrowserEvent('closeResetModal');
        return redirect()->route('dashboard');
    }
    public function closeResetModal(){
        $this->dispatchBrowserEvent('closeResetModal');
    }
    public function render()
    {
        return view('livewire.user-table',[
            'users' => User::search(trim($this->search))
                ->paginate(6)
        ]);
    }
}
