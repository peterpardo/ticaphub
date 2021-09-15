<?php

namespace App\Imports;

use App\Jobs\RegisterUserJob;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;

class UserImport implements ToCollection, WithHeadingRow
{   
    use Importable;
    
    public $school;
    public $specialization;

    public function __construct($school, $specialization) {
        $this->school = $school;
        $this->specialization = $specialization;
    }
    
    public function collection(Collection $rows)
    {   
        $ticap = Auth::user()->ticap_id;

        Validator::make($rows->toArray(), [
            '*.first_name' => ['required'],
            '*.middle_name' => ['required'],
            '*.last_name' => ['required'],
            '*.email' => ['required', 'email', 'unique:users,email'],
            '*.student_number' => ['required', 'numeric', 'max:99999999999', 'unique:users,student_number'],
            '*.group' => ['required'],
        ])->validate();

        foreach($rows as $row) {
            // GENERATE DEFAULT PASSWORD
            $tempPassword = "picab" . $row['student_number'];

            $user = User::create([
                'first_name' => Str::title($row['first_name']),
                'middle_name' => Str::title($row['middle_name']),
                'last_name' => Str::title($row['last_name']),
                'email' => $row['email'],
                'student_number' => $row['student_number'],
                'password' => Hash::make($tempPassword),
                'ticap_id' => $ticap,
            ]);

            // ADD USER WITH SCHOOL AND SPECIALIZATION
            $user->userProgram()->create([
                'school_id' => $this->school,
                'specialization_id' => $this->specialization,
            ]);

            $groupName = Str::upper($row['group']);
    
            if(!Group::where('name', $groupName)->exists()) {
                $group = Group::create([
                    'name' => $groupName,
                    'specialization_id' => $this->specialization,
                    'school_id' => $this->school,
                ]);

                $user->userGroup()->create([
                    'group_id' => $group->id,
                ]);
            } else {
                $group = Group::where('name', $groupName)->first();
                $user->userGroup()->create([
                    'group_id' => $group->id,
                ]);
            };

            // SEND LINK FOR CHANGING PASSWORD TO USER
            $token = Str::random(60) . time();
            $link = URL::temporarySignedRoute('set-password', now()->addDays(7), [
                'token' => $token, 
                'ticap' => $ticap,
                'email' => $user->email,
            ]);
            $details = [
                'title' => 'Welcome to TICaP Hub ' . $user->email,
                'body' => "You are invited! Click the link below",
                'link' => $link,
            ];

            DB::table('register_users')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            dispatch(new RegisterUserJob($user->email, $details));
        }
        
    }

}
