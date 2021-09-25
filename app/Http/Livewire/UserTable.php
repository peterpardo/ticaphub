<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Ticap;
use App\Models\TicapEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserTable extends Component
{       
    public $search;
    public $selectedUser;

    public function selectUser($userId){
        $this->dispatchBrowserEvent('openModal');
        $this->selectedUser = $userId;
    }
    public function deleteUser(){
        User::where('id', $this->selectedUser)->delete();
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
