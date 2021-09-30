<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class GroupExhibitForm extends Component
{   
    use WithFileUploads;

    public $groupId;
    public $title;
    public $description;
    public $heroFile;
    public $videoFile;
    protected $listeners = [
        'getGroupId',
        'closeUpdateModal'
    ];
    protected $rules = [
        'title' =>  'required',
        'description' =>  'required',
        'heroFile' =>  'required|image',
        // 'videoFile' =>  'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
    ];
    protected $messages = [
        'title.required' => 'Project Title is required',
        'description.required' => 'Project Description is required',
        'heroFile.required' => 'Hero Image is required',
        'heroFile.mimes' => 'Hero must be an image',
        // 'videoFile.required' => 'Project Video is required',
        // 'videoFile.mimes' => 'Video type is not valid'
    ];

    public function updateExhibit() {
        $this->validate();
        $group = Group::find($this->groupId);
        if($group->groupExhibit->hero_file != null) {
            unlink(storage_path('app/public/group-files/' . $group->groupExhibit->hero_file));
            $group->groupExhibit->hero_file = null;
            $group->groupExhibit->save();
        }
        $path = 'group-files/';
        $extension = $this->heroFile->extension();
        $fileName = Str::uuid() . '.' . $extension;
        $this->heroFile->storeAs($path, $fileName, 'public');
        if($group->groupExhibit()->exists()) {
            $group->groupExhibit()->update([
                'title' => $this->title,
                'description' => $this->description,
                'hero_file' => $path . $fileName,
                'ticap_id' => $group->ticap_id,
            ]);
        } else {
            $group->groupExhibit()->create([
                'title' => $this->title,
                'description' => $this->description,
                'hero_file' => $fileName,
                'ticap_id' => $group->ticap_id,
            ]);
        }
        $this->emit('refreshParent');
        $this->emit('groupExhibitUpdated');
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    // public function updatedHeroFile() {
    //     $this->validate([
    //         'heroFile' => 'image',
    //     ]);
    // }
    // public function updatedVideoFile() {
    //     $this->validate([
    //         'videoFile' => 'mimes:video/mp4,video/mpeg,video/quicktime',
    //     ]);
    // }
    public function closeUpdateModal() {
        $this->reset(['title', 'description', 'heroFile', 'videoFile']);
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeUpdateModal');
    }
    public function getGroupId($groupId) {
        $this->groupId = $groupId;
        $group = Group::find($groupId);
        // dd(Storage::url($group->groupExhibit->hero_file));
        if($group->groupExhibit()->exists()){
            $this->title = $group->groupExhibit->title;
            $this->description = $group->groupExhibit->description;
            $this->heroFile = $group->groupExhibit->hero_file;
            $this->videoFile = $group->groupExhibit->video_file;
        }
    }
    public function render()
    {
        return view('livewire.group-exhibit-form');
    }
}
