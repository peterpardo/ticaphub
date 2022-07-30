<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageForm extends Component
{
    use WithFileUploads;

    public GroupExhibit $groupExhibit;
    public $action = 'hero';
    public $showModal = false;
    public $file;

    protected $rules = [
        'file' => 'nullable|image|max:15000'
    ];

    protected $listeners = ['showModal'];

    public function showModal($action) {
        if ($action == 'poster') {
            $this->action = 'poster';
        } else if ($action == 'logo') {
            $this->action = 'logo';
        }
        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('action', 'showModal', 'file');
        $this->resetValidation();
    }

    public function removeImage() {
        if ($this->action == 'hero') {
            $this->groupExhibit->hero_image = null;
        } else if ($this->action == 'logo') {
            $this->groupExhibit->logo = null;
        } else {
            $this->groupExhibit->poster_image = null;
        }

        $this->file = null;
    }

    public function updateImage() {
        $this->validate();

        $image = null;
        if ($this->action == 'hero') {
            $image = $this->groupExhibit->hero_image;
        } else if ($this->action == 'logo') {
            $image = $this->groupExhibit->logo;
        } else {
            $image = $this->groupExhibit->poster_image;
        }

        // Delete previous image (hero or poster or logo)
        if (!is_null($image)) {
            $tempArray = explode('/', $image);
            $filePath = 'public/' . $tempArray[1]  . '/' . $tempArray[2];
            Storage::delete($filePath);
        }

        // Check if student has uploaded an image
        if ($this->file) {
            // Create file path for exhibit pictures
            $tempPath = $this->file->store('public/group-exhibits');
            $tempArray = explode('/', $tempPath);
            $filePath = 'storage/' . $tempArray[1]  . '/' . $tempArray[2];

            // Update exhibit image
            if ($this->action == 'hero') {
                $this->groupExhibit->hero_image = $filePath;
            } else if ($this->action == 'logo') {
                $this->groupExhibit->logo = $filePath;
            } else {
                $this->groupExhibit->poster_image = $filePath;
            }
        } else {
            // Check what to update
            if ($this->action == 'hero') {
                $this->groupExhibit->hero_image = null;
            } else if ($this->action == 'logo') {
                $this->groupExhibit->logo = null;
            } else {
                $this->groupExhibit->poster_image = null;
            }
        }
        $this->groupExhibit->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Group Exhibit successfully updated');

        return redirect('/group-exhibit');
    }

    public function render()
    {
        return view('livewire.group-exhibit.image-form');
    }
}
