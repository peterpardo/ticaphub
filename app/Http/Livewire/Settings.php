<?php

namespace App\Http\Livewire;

use App\Models\GroupExhibit;
use App\Models\School;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use ZipArchive;

class Settings extends Component
{
    public $isActive = 'settings';
    public $showModal = false;
    public Ticap $ticap;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'TICaP name successfully updated.');
        }
    }

    public function endEvent() {
        $superadmin = User::find(auth()->user()->id);

        // Create directory for all ticap archives (one time only)
        if (!is_dir(storage_path('app/public/ticap'))) {
            Storage::makeDirectory('public/ticap');
        }

        // Create directory for current ticap
        $dirName = time() . '-' . $superadmin->ticap_id;

        if (!is_dir(storage_path('app/public/ticap/' . $dirName))) {
           Storage::makeDirectory('public/ticap/' . $dirName);
        }

        // Create zip file for all exhibits (hero, posters and logos)
        $zip = new ZipArchive;
        $fileName = 'group-exhibits.zip';

        if ($zip->open(storage_path('app/public/ticap/' . $dirName . '/' . $fileName), ZipArchive::CREATE) === TRUE)
        {
            $groupExhibits = GroupExhibit::with('group:id,name')->get();

            // Loop through all exhibits
            foreach ($groupExhibits as $exhibit) {
                $this->addFileToZip($exhibit->hero_image, $exhibit->group->name, $zip);
                $this->addFileToZip($exhibit->poster_image, $exhibit->group->name, $zip);
                $this->addFileToZip($exhibit->logo, $exhibit->group->name, $zip);
            }

            $zip->close();
        }

        dd('done zipping.');

        // Delete users
        $this->deleteUsers();

        // Set current ticap to done
        $this->ticap->is_done = true;
        $this->ticap->save();

        // Set ticap_id of superadmin to null
        $superadmin->ticap_id = null;
        $superadmin->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Congratulations! TICaP has been successfully ended.');

        return redirect()->route('dashboard');
    }

    public function addFileToZip($file, $groupName, $zip) {
        $tempFile = null;

        // Check if group has image file
        if (!is_null($file)) {
            $tempFile = Str::replaceFirst('storage', 'public', $file);
        }

        // Check if file exists, add to zip file of group
        if (Storage::disk('local')->exists($tempFile)) {
            $filePath = storage_path('app/') . $tempFile;
            $relativeNameInZipFile = Str::slug($groupName) . '/' . basename($filePath);
            $zip->addFile($filePath, $relativeNameInZipFile);
        }
    }

    public function deleteUsers() {
        // Delete all users (except superadmin)
        User::where('id', '!=', auth()->user()->id)->delete();

        // Delete all roles (except superadmin)
        DB::table('model_has_roles')->where('model_id', '!=', auth()->user()->id)->delete();

        // Delete all permissions for all users
        DB::table('model_has_permissions')->truncate();

        // Delete all unregistered emails
        DB::table('register_users')->truncate();

        // Delete all groups
        DB::table('groups')->delete();

        // Delete all advisers
        DB::table('advisers')->delete();

        // Delete all specializations
        DB::table('specializations')->delete();

        // Delete all elections
        DB::table('elections')->delete();

        // Reset schools
        School::where('id', '!=' , 1)->update(['is_involved' => 0]);
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
