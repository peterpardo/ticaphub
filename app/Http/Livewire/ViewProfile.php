<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public $fname;
    public $mname;
    public $lname;
    public $profilePicture;

    public $rules = [
        'fname' => 'required|max:30',
        'mname' => 'nullable|string|max:30',
        'lname' => 'required|max:30',
        'profilePicture' => 'nullable|image|max:5000'
    ];

    protected $validationAttributes = [
        'fname' => 'first name',
        'mname' => 'middle name',
        'lname' => 'last name',
    ];

    public function mount() {
        $this->fname = $this->user->first_name;
        $this->mname = $this->user->middle_name;
        $this->lname = $this->user->last_name;
    }

    public function updatedProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'nullable|image'
        ]);
    }

    public function updateProfile() {
        $this->validate();

        // Check if user changed profile picture
        if ($this->profilePicture) {
            // Delete old profile picture
            if (!is_null($this->user->profile_picture)) {
                $tempArray = explode('/', $this->user->profile_picture);
                $filePath = 'public/' . $tempArray[1]  . '/' . $tempArray[2];
                Storage::delete($filePath);
            }

            // Create file path for profile picture
            $tempPath = $this->profilePicture->store('public/profile-pictures');
            $tempArray = explode('/', $tempPath);
            $filePath = 'storage/' . $tempArray[1]  . '/' . $tempArray[2];

            // Update profile image
            $this->user->profile_picture = $filePath;
        }

        // Update profile
        $this->user->first_name = $this->fname;
        $this->user->middle_name = $this->mname;
        $this->user->last_name = $this->lname;
        $this->user->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Profile successfully updated');

        // Reset input validations
        $this->resetValidation();
        $this->reset('profilePicture');

        return redirect()->route('view-profile');
    }

    public function render()
    {
        return view('livewire.view-profile');
    }
}
