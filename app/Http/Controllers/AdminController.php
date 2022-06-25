<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Jobs\RegisterUserJob;
use App\Mail\InvitationMail;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function importStudents() {
        return view('users.import-students');
    }

    // Used in /users/import-students
    public function getSchools() {
        return School::active()->get()->toJson();
    }

    // Used in /users/import-students
    public function getSpecializations($id) {
        return Specialization::where('school_id', $id)->get()->toJson();
    }

    public function uploadFile(Request $request) {
        $request->validate([
            'school' => 'required',
            'specialization' => 'required',
            'file' => 'required|mimes:txt,csv'
        ]);;

        DB::transaction(function () use ($request) {
            // Read file
            $ctr = 1;
            if (($handle = fopen($request->file('file'), "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    // Skip the first row of the csv file
                    if ($ctr == 1) {
                        $ctr++;
                        continue;
                    }

                    // First row / Header
                    $fields = [
                        'first_name' => trim($row[0]),
                        'middle_name' => trim($row[1]),
                        'last_name' => trim($row[2]),
                        'email' => trim($row[3]),
                        'group' => trim($row[4]),
                    ];

                    $validator = Validator::make($fields, [
                        'first_name' => 'required|max:50',
                        'middle_name' => 'string|max:50',
                        'last_name' => 'required|max:50',
                        'email' => 'required|email|unique:users,email|max:50',
                        'group' => 'required|max:50',
                    ]);

                    // Throw exceptions when validation error occurs
                    if ($validator->fails()) {
                        $errors = $validator->errors();

                        if ($errors->has('first_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('first_name'));
                        }
                        if ($errors->has('middle_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('middle_name'));
                        }
                        if ($errors->has('last_name')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('last_name'));
                        }
                        if ($errors->has('email')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('email'));
                        }
                        if ($errors->has('group')) {
                            throw new GeneralException('Line ' . $ctr . ': ' . $errors->first('group'));
                        }
                    }

                    // Add user
                    $user = User::create([
                        'first_name' => $fields['first_name'],
                        'middle_name' => $fields['middle_name'],
                        'last_name' => $fields['last_name'],
                        'password' => '123',
                        'email' => $fields['email'],
                        'ticap_id' => auth()->user()->ticap_id
                    ]);

                    // Register user and send invitation email
                    RegisterUserJob::dispatch($user);

                    // Proceed to next student
                    $ctr++;
                }
                fclose($handle);
            }
        });

        $request->session()->flash('message', 'Invitation emails will be sent to the students. This may take a few hours to finish depending on the number of students');
        $request->session()->flash('status', 'green');

        return back();
    }
}
