<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\GroupFile;
use App\Models\Ticap;
use Illuminate\Support\Facades\Auth;
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
    public $updateAdviser  = false;
    public $adviser;
    public $updateEmail = false;
    public $email;
    public $updateLink  = false;
    public $link;
    public $updateBanner  = false;
    public $currentBanner;
    public $banner;
    public $updateVideo = false;
    public $currentVideo;
    public $video;
    public $uploadedFiles = [];
    protected $rules = [
        'uploadedFiles.*' => 'required|max:25000'
    ];
    protected $messages = [
        'uploadedFiles.*.max' => 'File size is too large (max: 25mb)',
        'uploadedFiles.*.required' => 'File/s is/are required',
    ];
    
    public function mount() {
        $this->currentBanner = $this->group->groupExhibit->banner_path;
        $this->currentVideo = $this->group->groupExhibit->video_path;
        $this->currentLink = $this->group->groupExhibit->link;
    }
    public function render() {
        $files = GroupFile::where('group_id', $this->group->id)->orderBy('created_at', 'desc')->get();
        $ticap = Ticap::find(Auth::user()->ticap_id);
        return view('livewire.group-exhibit', [
            'files' => $files,
            'ticap' => $ticap
        ]);
    }
    public function saveVideo() {
        $this->validate([
            'video' => 'required|file|mimes:mp4,ogx,oga,ogv,ogg,webm|max:400000'
        ]);
        if($this->group->groupExhibit->video_path != null && $this->group->groupExhibit->video_path != 'assets/sample-video.mp4') {
            unlink(storage_path('app/public/' . $this->group->groupExhibit->video_path));
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
        if($this->group->groupExhibit->banner_path != null && $this->group->groupExhibit->banner_path != 'assets/banner.png') {
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

    public function updated($uploadedFiles){
        $this->validateOnly($uploadedFiles);
    }

    public function upload() {
        $this->validate([
            'uploadedFiles.*' => 'required|max:25000'
        ]);
        foreach($this->uploadedFiles as $uploadedFile) {
            $path = 'group-files/';
            $extension = $uploadedFile->extension();
            $fileName = Str::uuid() . '.' . $extension;
            $originalName = $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs($path, $fileName, 'public');
            $this->group->files()->create([
                'name' => $originalName,
                'path' => $path . $fileName,
            ]);
        }
        session()->flash('fileMsg', 'File successfully uploaded');
        $this->emit('resetFileUpload');
        $this->uploadedFiles = [];
    }
    
    public function cancelUpload() {
        $this->emit('resetFileUpload');
        $this->uploadedFiles = [];
    }

    public function selectFile($fileId, $action) {
        $this->fileId = $fileId;
        if($action == 'delete') {
            $this->dispatchBrowserEvent('openDeleteModal');
        } else {
            $file = GroupFile::find($fileId);
            return response()->download(storage_path('app/public/'. $file->path));
        }
    }

    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }

    public function deleteFile() {
        $file = GroupFile::find($this->fileId);
        unlink(storage_path('app/public/' . $file->path));
        $file->delete();
        session()->flash('fileMsg', 'File successfully deleted');
    }

    public function closeLink() {
        $this->updateLink = false;
    }
    public function saveLink() {
        $this->group->groupExhibit->link = $this->link;
        $this->group->groupExhibit->save();
        $this->emit('groupExhibitUpdated');
        $this->updateLink = false;
        $this->emit('reloadPage');
    }
    public function updateLink() {
        if($this->group->groupExhibit()->exists()) {
            $this->link = $this->group->groupExhibit->link;
        }
        $this->updateLink = true;
    }

    public function closeAdviser() {
        $this->resetValidation();
        $this->updateAdviser = false;
    }
    public function saveAdviser() {
        $this->validate([
            'adviser' => 'string'
        ]);
        $this->group->adviser = $this->adviser;
        $this->group->save();
        $this->emit('groupExhibitUpdated');
        $this->updateAdviser = false;
    }
    public function updateAdviser() {
        if($this->group->adviser) {
            $this->adviser = $this->group->adviser;
        }
        $this->updateAdviser = true;
    }

    public function closeEmail() {
        $this->resetValidation();
        $this->updateEmail = false;
    }
    public function saveEmail() {
        $this->validate([
            'email' => 'email|unique:groups,adviser_email'
        ]);
        $this->group->adviser_email = $this->email;
        $this->group->save();
        $this->emit('groupExhibitUpdated');
        $this->updateEmail = false;
    }
    public function updateEmail() {
        if($this->group->adviser_email) {
            $this->email = $this->group->adviser_email;
        }
        $this->updateEmail = true;
    }
}
