<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CommitteeNotification extends Component
{
    public User $user;
    
    public function render()
    {
        return view('livewire.committee-notification');
    }
}
