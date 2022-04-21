<?php

namespace App\Http\Livewire;

use App\Exceptions\GeneralException;
use App\Jobs\RegisterUserJob;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportStudent extends Component
{
    use WithFileUploads;

    public $selectedSchool;
    public $selectedSpec;
    public $specializations;
    public $file;
    protected $rules = [
        'selectedSpec' => 'required',
        'selectedSchool' => 'required',
    ];
    protected $messages = [
        'selectedSpec.required' => 'Specialization is required.',
        'selectedSchool.required' => 'School is required.',
    ];

    public function render() {
        $schools = School::where('is_involved', 1)->get();

        return view('livewire.import-student', [
            'schools' => $schools
        ]);
    }

    public function updatedSelectedSchool($schoolId) {
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }

    public function importStudents() {

        // Validation for the file
        // Checks if file type is CSV
        if($this->file) {
            if($this->file->getClientOriginalExtension() != 'csv') {
                session()->flash('message', 'File must be in csv format.');
                session()->flash('status', 'red');

                return back();
            }
        }

        // Rollbacks all inserted students if a signle field is missing
        return DB::transaction(function() {
            // Validation for the school and specialization
            $this->validate();

            $file = $this->file;
            $specialization = $this->selectedSpec;
            // Reads file
            $ctr = 1;
            if (($handle = fopen($this->file, "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    if($ctr == 1){
                        $ctr++;
                        continue;
                    }

                    // Headers
                    $fields = [];
                    $fields['first_name'] = trim($row[0]);
                    $fields['middle_name'] = trim($row[1]);
                    $fields['last_name'] = trim($row[2]);
                    $fields['email'] = trim($row[3]);
                    $fields['id_number'] = trim($row[4]);
                    $fields['group'] = trim($row[5]);

                    // Checks if each cell is filled out
                    foreach($fields as $key => $value) {
                        // Exclude middle name of student as required
                        if($key != 'middle_name' && $value == "") {
                            throw new GeneralException('Line ' . $ctr . ' - ' . $key . ' is missing.');
                        }
                    }
                } // temp while loop closing bracket
            } // temp if loop closing bracket

            //         // Generate default password Ex. picab201811780
            //         $tempPassword = "picab" . $fields['id_number'];

            //         // VALIDATE EMAIL AND STUDENT NUMBER
            //         if(User::where('email', $fields['email'])->exists() ){
            //             throw new GeneralException('Line ' . $ctr . ' - Email must be unique');
            //         }

            //         // Create student
            //         $ticap = Auth::user()->ticap_id;
            //         $user = User::create([
            //             'first_name' => Str::title($fields['first_name']),
            //             'middle_name' => Str::title($fields['middle_name']),
            //             'last_name' => Str::title($fields['last_name']),
            //             'password' => Hash::make($tempPassword),
            //             'email' => $fields['email'],
            //             'ticap_id' => $ticap,
            //         ]);
            //         // ASSIGN STUDENT ROLE
            //         $user->assignRole('student');
            //         // ADD STUDENT WITH SPECIALIZATION
            //         $user->userSpecialization()->create([
            //             'specialization_id' => $specialization,
            //             'id_number' => $fields['id_number'],
            //         ]);
            //         // CHECK IF GROUP EXISTS
            //         $groupName = Str::upper($fields['group']);
            //         if(!Group::where('name', $groupName)->exists()) {
            //             $group = Group::create([
            //                 'name' => $groupName,
            //                 'specialization_id' => $specialization,
            //                 'ticap_id' => $ticap,
            //             ]);
            //             // CREATE DEFAULT GROUP EXHIBIT
            //             if(!$group->groupExhibit()->exists()) {
            //                 $group->groupExhibit()->create([
            //                     'ticap_id' => $ticap,
            //                 ]);
            //             }
            //             $user->userGroup()->create([
            //                 'group_id' => $group->id,
            //             ]);
            //         } else {
            //             $group = Group::where('name', $groupName)->first();
            //             $user->userGroup()->create([
            //                 'group_id' => $group->id,
            //             ]);
            //         }
            //         // CREATE GROUP EXHIBIT FOR THE GROUP
            //         if(!$user->userGroup->group->groupExhibit()->exists()) {
            //             $user->userGroup->group->groupExhibit()->create([
            //                 'ticap_id' => $ticap,
            //             ]);
            //         }
            //         $ctr++;
            //     }
            //     fclose($handle);
            // }
            // // SEND EMAILS
            // $ctr = 1;
            // if (($handle = fopen($file, "r")) !== FALSE) {
            //     while (($row = fgetcsv($handle, 1000)) !== FALSE) {
            //         if($ctr == 1){
            //             $ctr++;
            //             continue;
            //         }
            //         // GET EMAIL
            //         $email = trim($row[3]);
            //         // SEND LINK FOR CHANGING PASSWORD TO USER
            //         $token = Str::random(60) . time();
            //         $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
            //             'token' => $token,
            //             'ticap' => Auth::user()->ticap_id,
            //             'email' => $email,
            //         ]);
            //         $details = [
            //             'title' => 'Welcome to TICaP Hub ' . $email,
            //             'body' => "You are invited! Click the link below",
            //             'link' => $link,
            //         ];
            //         DB::table('register_users')->insert([
            //             'email' => $email,
            //             'token' => $token,
            //             'created_at' =>  date('Y-m-d H:i:s'),
            //             'updated_at' => date('Y-m-d H:i:s'),
            //         ]);
            //         dispatch(new RegisterUserJob($email, $details));
            //     }
            // }
            // session()->flash('message', 'Email has been sent successfully');
            // session()->flash('status', 'green');
            // return back();
        });
    }
}
