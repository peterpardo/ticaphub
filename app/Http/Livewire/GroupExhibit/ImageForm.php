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
        'file' => 'image|max:15000'
    ];

    protected $listeners = ['showModal'];

    public function showModal($action) {
        if ($action == 'poster') {
            $this->action = 'poster';
        }
        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('action', 'showModal', 'file');
        $this->resetValidation();
    }

    public function removeImage() {
        ($this->action == 'hero')
            ? $this->groupExhibit->hero_image = null
            : $this->groupExhibit->poster_image = null;

        $this->file = null;
    }

    public function updateImage() {
        // Delete previous image (hero or poster)
        $image = null;
        if ($this->action == 'hero') {
            $image = $this->groupExhibit->hero_image;
        } else {
            $image = $this->groupExhibit->poster_image;
        }

        if (!is_null($image)) {
            $tempArray = explode('/', $image);
            $filePath = 'public/' . $tempArray[1]  . '/' . $tempArray[2];
            Storage::delete($filePath);
        }

        // Check if student has uploaded an image
        if ($this->file) {
            $this->validate();

            // Create file path for exhibit pictures
            $tempPath = $this->file->store('public/group-exhibits');
            $tempArray = explode('/', $tempPath);
            $filePath = 'storage/' . $tempArray[1]  . '/' . $tempArray[2];

            // Update exhibit image
            if ($this->action == 'hero') {
                $this->groupExhibit->hero_image = $filePath;
            } else {
                $this->groupExhibit->poster_image = $filePath;
            }
        } else {
            ($this->action == 'hero')
                ? $this->groupExhibit->hero_image = null
                : $this->groupExhibit->poster_image = null;
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
