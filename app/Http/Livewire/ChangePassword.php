<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public User $user;
    public $showModal = false;
    public $oldPassword = '';
    public $newPassword = '';
    public $confirmPassword = '';

    protected $rules = [
        'oldPassword' => 'required',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|min:6',
    ];

    protected $listeners = ['showModal'];

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->resetInput();
        $this->showModal = false;
    }

    public function resetInput() {
        $this->resetValidation();
        $this->reset('oldPassword', 'newPassword', 'confirmPassword');
    }

    public function updatedOldPassword() {
        $this->resetValidation();
    }

    public function updatedNewPassword() {
        $this->resetValidation();
    }

    public function updatedConfirmPassword() {
        $this->resetValidation();
    }

    public function changePassword() {
        $this->validate();

        // If oldPassword is the same as current password, throw error
        if (!Hash::check($this->oldPassword, auth()->user()->password)) {
            $this->addError('oldPassword', 'Please enter the correct password');
            return;
        }

        // If newPassword is the same as the old password, throw an error
        if ($this->newPassword === $this->oldPassword) {
            $this->addError('newPassword', 'Please enter a new password');
        }

        // If newPassword !== confirmPassword, throw error
        if ($this->newPassword !== $this->confirmPassword) {
            $this->addError('newPassword', 'New and Re-typed password did not match.');
            return;
        }

        // Update user password
        $this->user->password = Hash::make($this->newPassword);
        $this->user->save();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
