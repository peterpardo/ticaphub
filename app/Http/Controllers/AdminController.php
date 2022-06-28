<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Jobs\RegisterUserJob;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserElection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function importStudents() {
        return view('users.import-students');
    }

    public function uploadFile(Request $request) {
        $validated = $request->validate([
            'school' => 'required',
            'specialization' => 'required',
            'file' => 'required|mimes:txt,csv',
        ]);

        DB::transaction(function () use ($request) {
            // Read file
            $ctr = 1;
            if (($handle = fopen($request->file, "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    // Skip the header
                    if ($ctr == 1) {
                        $ctr++;
                        continue;
                    }

                    // HEADERS
                    $fields = [
                        'first_name' => trim($row[0]),
                        'middle_name' => trim($row[1]),
                        'last_name' => trim($row[2]),
                        'email' => trim($row[3]),
                        'group' => trim($row[4]),
                    ];

                    // Validate fields
                    $validator = Validator::make($fields, [
                        'first_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:50',
                        'middle_name' => 'regex:/^[a-zA-Z\s]*$/|max:50',
                        'last_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:50',
                        'email' => 'required|email|unique:users,email|max:100',
                    ] ,[
                        'regex' => 'The :attribute must be letters and spaces only.'
                    ]);

                    // Throw exception if error exsits
                    if ($validator->fails()) {
                        $errors = $validator->errors();

                        if ($errors->has('first_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('first_name'));
                        } else if ($errors->has('middle_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('middle_name'));
                        } else if ($errors->has('last_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('last_name'));
                        } else if ($errors->has('email')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('email'));
                        }
                    }

                    // Add student
                    $user = User::create([
                        'first_name' => $fields['first_name'],
                        'middle_name' => $fields['middle_name'],
                        'last_name' => $fields['last_name'],
                        'password' => Hash::make('ticap123'),
                        'email' => $fields['email'],
                        'ticap_id' => auth()->user()->ticap_id,
                    ]);

                    // // Add group if it doesn't exists
                    // $formattedName = Str::title($fields['group']);
                    // $nameExists = Group::where('name', '=', $formattedName)->exists();
                    // $groupId = '';
                    // if (!$nameExists) {
                    //     // Add group
                    //     throw new GeneralException('Line ' . $ctr . ': creating group');
                    //     $group = Group::create([
                    //         'name' => $formattedName,
                    //         'specialization_id' => $request->specialization,
                    //         'ticap_id' => auth()->user()->ticap_id,
                    //     ]);

                    //     // Get group id
                    //     $groupId = $group->id;
                    // } else {
                    //     $groupId = Group::where('name', $formattedName)->pluck('id')->first();
                    // };

                    // // Create student details (user_specialization)
                    // $user->userSpecialization()->create([
                    //     'specialization_id' => $request->specialization,
                    //     'group_id' => $groupId,
                    // ]);

                    // // Assign user which election to vote
                    // $electionId = Specialization::select('election_id')->where('id', $request->specialization)->pluck('election_id')->first();
                    // UserElection::insert([
                    //     'user_id' => $user->id,
                    //     'election_id' => $electionId,
                    //     'has_voted' => 0,
                    //     'created_at' => now()->toDateTimeString(),
                    //     'updated_at' => now()->toDateTimeString(),
                    // ]);

                    // Increment ctr to proceed to next student
                    $ctr++;
                }
                fclose($handle);
            }
        });

        $request->session()->flash('message', 'Users have been added. Invitation Emails will be sent.');
        $request->session()->flash('status', 'green');

        return back();
    }

    public function getSchools() {
        return School::active()->get()->toJson();
    }

    public function getSpecializations($id) {
        return Specialization::select('id', 'name')->where('school_id', $id)->get()->toJson();
    }
}
