<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskNotification extends Component
{
    public function render()
    {
        return view('livewire.task-notification', [
            'user' => User::find(Auth::user()->id)  
        ]);
    }
}
