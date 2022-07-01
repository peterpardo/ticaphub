<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfile extends Component
{
    public User $user;
    public $email;
    public $fname;
    public $mname;
    public $lname;

    public function render()
    {
        return view('livewire.view-profile');
    }
}
