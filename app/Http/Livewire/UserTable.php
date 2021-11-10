<?php

namespace App\Http\Livewire;

use App\Models\Committee;
use App\Models\Event;
use App\Models\Group;
use App\Models\Officer;
use App\Models\ProgramFlow;
use App\Models\Slider;
use App\Models\Specialization;
use App\Models\Stream;
use App\Models\TaskList;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PDF;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class UserTable extends Component
{       
    use WithPagination;

    public $search;
    public $selectedUser;

    public function selectUser($userId){
        $this->selectedUser = $userId;
        $this->dispatchBrowserEvent('openModal');
    }
    public function deleteUser(){
        $user = User::find($this->selectedUser);
        // INVALIDATE REGISTRATION LINK SENT TO USER IF STILL NOT VERIFIED
        DB::table('register_users')->where('email', $user->email)->delete();
        $user->delete();
        $this->emit('userDeleted');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function closeModal(){
        $this->dispatchBrowserEvent('closeModal');
    }
    public function resetUserBtn() {
        $this->dispatchBrowserEvent('openResetModal');
    }
    public function resetUsers() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        // ARCHIVE EVENTS AND EVENT FILES
        foreach($ticap->events as $event) {
            // EVENT
            $archivedEvent = $ticap->archivedEvents()->create([
                'name' => $event->name
            ]);
            // TASK FILES
            foreach($event->files as $file) {
                $archivedEvent->archivedFiles()->create([
                    'name' => $file->name,
                    'path' => $file->path,
                ]);
            }
            // PROGRAM FLOW
            foreach($event->programs as $program) {
                $archivedEvent->archivedPrograms()->create([
                    'name' => $program->name,
                    'path' => $program->path
                ]);
            }
        }

        // ARCHIVE CAPSTONE GROUP FILES IF GROUPS EXISTS
        if($ticap->groups->count() != 0) {
            foreach($ticap->groups as $group) {
                // ARCHIVE GROUP NAME
                $archivedExhibit = $ticap->archivedExhibits()->create([
                    'name' => $group->name
                ]);
                // ARCHIVE GROUP BANNER
                if($group->groupExhibit->banner_name != null && $group->groupExhibit->banner_path != null) {
                    $archivedExhibit->files()->create([
                        'name' => $group->groupExhibit->banner_name,
                        'path' => $group->groupExhibit->banner_path,
                    ]);
                }
                if($group->groupExhibit->video_name != null && $group->groupExhibit->video_path != null) {
                    // ARCHIVE GROUP VIDEO
                    $archivedExhibit->files()->create([
                        'name' => $group->groupExhibit->video_name,
                        'path' => $group->groupExhibit->video_path,
                    ]);
                }
                // ARCHIVE OTHER GROUP FILES
                if($group->files()->count() > 0) {
                    foreach($group->files as $file) {
                        $archivedExhibit->files()->create([
                            'name' => $file->name,
                            'path' => $file->path,
                        ]);
                    }
                }
            } 

            //  GENERATE AND DOCUMENT CAPSTONE GROUPS
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'capstone-groups';
            $ticap->archivedGroups()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'groups' => Group::orderBy('specialization_id', 'asc')->get(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.groups', $data);
            Storage::put($path, $pdf->output());
        }
        
        // ARCHIVE PROJECT ASSESSMENT FILES IF AWARDS IS SET
        if($ticap->awards_is_set) {
            // GENERATE AND DOCUMENT THE PDF FILE FOR WINNER CERTIFICATES 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'winner-certificates';
            $ticap->archivedWinnerCertificates()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'specs' => Specialization::all(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.certificate', $data)->setPaper('a4', 'landscape');
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR RECOGNITION CERTIFICATES 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'recognition-certificates';
            $ticap->archivedRecognitionCertificates()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'studs' => User::role('student')->with(['userSpecialization.specialization'])->get(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.student-certificate', $data)->setPaper('a4', 'landscape');
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR PANELIST CERTIFICATES 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'panelist-certificates';
            $ticap->archivedPanelistCertificates()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'panelists' => User::role('panelist')->get(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.panelist-certificate', $data)->setPaper('a4', 'landscape');
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR RUBRICS 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'rubrics';
            $ticap->archivedRubrics()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'specs' => Specialization::all(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.rubrics', $data);
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR GRADED RUBRICS 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'graded-rubrics';
            $ticap->archivedGradedRubrics()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'specs' => Specialization::all(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.graded-rubrics', $data);
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR PANELISTS 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'panelists';
            $ticap->archivedPanelists()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'specs' => Specialization::all(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.panelists', $data);
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR AWARDEES 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'awardees';
            $ticap->archivedAwardees()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'specs' => Specialization::all(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.awards', $data);
            Storage::put($path, $pdf->output());
        }
       
        if($ticap->election_finished) {
            // GENERATE AND DOCUMENT THE PDF FILE FOR OFFICERS 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'officers';
            $ticap->archivedOfficers()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'officers' => Officer::orderBy('election_id', 'asc')->get(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.officers', $data);
            Storage::put($path, $pdf->output());

            // GENERATE AND DOCUMENT THE PDF FILE FOR COMMITTEES 
            $path = 'public/reports/' . Str::uuid() . '.pdf';
            $fileName = 'committees';
            $ticap->archivedCommittees()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            $data = [
                'committees' => Committee::orderBy('user_id', 'asc')->get(),
                'ticap' => Ticap::find(Auth::user()->ticap_id)
            ];
            $pdf = PDF::loadView('reports.committees', $data);
            Storage::put($path, $pdf->output());
        }
       
        // DELETE ALL STUDENTS
        $users = User::role(['student', 'panelist'])->get();
        foreach($users as $user) {
            $user->syncRoles([]);
            $user->delete();
        }
        // DELETE TABLES
        foreach(TaskList::all() as $list) {
            $list->delete();
        }
        foreach(Group::all() as $group) {
            $group->delete();
        }
        foreach(Committee::all() as $committee) {
            $committee->delete();
        }
        foreach(ProgramFlow::all() as $program) {
            $program->delete();
        }
        
        // DELETE REGISTER_USERS TABLE
        DB::table('register_users')->truncate();
        
        // DELETE ALL ADDED EVENTS
        Event::where('id', '!=', 1)
        ->where('id', '!=', 2)
        ->where('id', '!=', 3)
        ->delete();

        // DELETE ALL ADDED SLIDERS
        Slider::where('id', '!=', 1)->delete();

        // DELETE ALL ADDED STREAMS
        Stream::truncate();

        // RESET TICAP
        $admins = User::role('admin')->get();
        foreach($admins as $admin) {
            $admin->ticap_id = null;
            $admin->save();
        }
        // SET TICAP TO FINISHED
        $ticap->is_done = 1;
        $ticap->save();
        $this->dispatchBrowserEvent('closeResetModal');
        session()->flash('status', 'green');
        session()->flash('message', 'TICaP successfully saved');
        return redirect()->route('dashboard');
    }
    public function closeResetModal(){
        $this->dispatchBrowserEvent('closeResetModal');
    }
    public function render()
    {
        return view('livewire.user-table',[
            'users' => User::search(trim($this->search))
                ->paginate(6)
        ]);
    }
}
