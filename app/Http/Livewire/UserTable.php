<?php

namespace App\Http\Livewire;

use App\Models\User;
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
        User::role('student')->delete();
        $this->dispatchBrowserEvent('closeResetModal');
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
