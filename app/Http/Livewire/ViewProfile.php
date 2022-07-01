<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfile extends Component
{
    public User $user;
    public $fname;
    public $mname;
    public $lname;


    public $rules = [
        'fname' => 'required|max:30',
        'mname' => 'nullable|string|max:30',
        'lname' => 'required|max:30',
    ];

    protected $validationAttributes = [
        'fname' => 'first Name',
        'mname' => 'middle Name',
        'lname' => 'last Name',
    ];

    public function mount() {
        $this->fname = $this->user->first_name;
        $this->mname = $this->user->middle_name;
        $this->lname = $this->user->last_name;
    }

    public function updateProfile() {
        $this->validate();

        dd('update profile');
    }

    public function render()
    {
        return view('livewire.view-profile');
    }
}
