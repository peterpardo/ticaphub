<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class GroupExhibit extends Component
{
    use WithFileUploads;

    public Group $group;
    public $updateTitle  = false;
    public $title;
    public $updateDesc  = false;
    public $desc;
    public $updateBanner  = false;
    public $currentBanner;
    public $banner;
    public $updateVideo = false;
    public $currentVideo;
    public $video;
    public $listeners = [
        'refreshParent' => '$refresh'
    ];
    
    public function mount() {
        $this->currentBanner = $this->group->groupExhibit->banner_path;
        $this->currentVideo = $this->group->groupExhibit->video_path;
    }
    public function saveVideo() {
        $this->validate([
            'video' => 'required|file|mimes:mp4,ogx,oga,ogv,ogg,webm'
        ]);
        if($this->group->groupExhibit->video_path != null) {
            unlink(storage_path('app/public/' . $this->group->groupExhibit->video_path));
            $this->group->groupExhibit->save();
        }
        $path = 'group-files/';
        $extension = $this->video->extension();
        $fileName = Str::uuid() . '.' . $extension;
        $originalName = $this->video->getClientOriginalName();
        $this->video->storeAs($path, $fileName, 'public');
        $this->group->groupExhibit()->update([
            'video_name' => $originalName,
            'video_path' => $path . $fileName,
        ]);
        $this->currentVideo = $path . $fileName;
        $this->video = null;
        $this->updateVideo = false;
        $this->emit('groupExhibitUpdated');
    }
    public function closeVideo() {
        $this->resetValidation();
        $this->video = null;
        $this->updateVideo = false;
    }
    public function updateVideo() {
        $this->updateVideo = true;
    }
    public function saveBanner() {
        $this->validate([
            'banner' => 'required|image'
        ]);
        if($this->group->groupExhibit->banner_path != null) {
            unlink(storage_path('app/public/' . $this->group->groupExhibit->banner_path));
            $this->group->groupExhibit->save();
        }
        $path = 'group-files/';
        $extension = $this->banner->extension();
        $fileName = Str::uuid() . '.' . $extension;
        $originalName = $this->banner->getClientOriginalName();
        $this->banner->storeAs($path, $fileName, 'public');
        $this->group->groupExhibit()->update([
            'banner_name' => $originalName,
            'banner_path' => $path . $fileName,
        ]);
        $this->currentBanner = $path . $fileName;
        $this->banner = null;
        $this->updateBanner = false;
        $this->emit('groupExhibitUpdated');
    }
    public function closeBanner() {
        $this->resetValidation();
        $this->banner = null;
        $this->updateBanner = false;
    }
    public function updateBanner() {
        $this->updateBanner = true;
    }
    public function saveDesc() {
        $this->group->groupExhibit->description = $this->desc;
        $this->group->groupExhibit->save();
        $this->emit('groupExhibitUpdated');
        $this->updateDesc = false;
    }
    public function closeDesc() {
        $this->updateDesc = false;
    }
    public function updateDesc() {
        $this->desc = $this->group->groupExhibit->description;
        $this->updateDesc = true;
    }
    public function closeTitle() {
        $this->updateTitle = false;
    }
    public function saveTitle() {
        $this->group->groupExhibit->title = $this->title;
        $this->group->groupExhibit->save();
        $this->emit('groupExhibitUpdated');
        $this->updateTitle = false;
    }
    public function updateTitle() {
        if($this->group->groupExhibit()->exists()) {
            $this->title = $this->group->groupExhibit->title;
        }
        $this->updateTitle = true;
    }
    public function openUpdateModal($groupId) {
        $this->emit('getGroupId', $groupId);
        $this->dispatchBrowserEvent('openUpdateModal');
    }
    public function render()
    {
        return view('livewire.group-exhibit');
    }
}
