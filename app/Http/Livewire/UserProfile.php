<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $id_number;
    public $current_profile;
    public $profile_picture;
    public $profileChanged = false;
    protected $rules = [
        'first_name' => 'required|string',
        'middle_name' => 'required|string',
        'last_name' => 'required|string',
    ];

    public function mount() {
        $this->first_name = $this->user->first_name;
        $this->middle_name = $this->user->middle_name;
        $this->last_name = $this->user->last_name;
        $this->current_profile = $this->user->profile_picture;
        if($this->user->hasRole('student') && $this->id_number){
            $this->validate([
                'id_number' => 'numeric'
            ]);
            $this->id_number = $this->user->userSpecialization->id_number;
        }
    }
    public function render() {
        return view('livewire.user-profile');
    }

    public function updateUserDetails() {
        $this->validate();
        $this->user->first_name = $this->first_name;
        $this->user->middle_name = $this->middle_name;
        $this->user->last_name = $this->last_name;
        $this->user->save();
        if($this->user->hasRole('student')) {
            $this->user->userSpecialization->id_number = $this->id_number;
            $this->user->userSpecialization->save();
        }
        $this->resetValidation();
        $this->profileChanged = false;
        $this->emit('profileUpdated');
    }
    public function updatedProfilePicture($value) {
        $this->resetValidation();
        $this->validateOnly($value, [
            'profile_picture' => 'mimes:png,jpeg,jpg|max:5000'
        ], [
            'profile_picture.mimes' => 'File should be an image',
            'profile_picture.max' => 'File should be less than 5mb',
        ]);
        $this->profileChanged = true;
    }
    public function updateProfile() {
        if($this->user->profile_picture && $this->user->profile_picture != 'profiles/default-img.png') {
            unlink(storage_path('app/public/'.$this->user->profile_picture));
        }
        $extension = $this->profile_picture->extension();
        $path = 'profiles/';
        $fileName = Str::uuid() . '.' . $extension;
        $this->profile_picture->storeAs($path, $fileName, 'public');
        $this->user->profile_picture = $path . $fileName;
        $this->user->save();
        $this->resetValidation();
        $this->profileChanged = false;
        $this->emit('profileUpdated');
    }
    public function cancelUpdate() {
        $this->reset('profile_picture');
        $this->resetValidation();
        $this->profileChanged = false;
    }
}
