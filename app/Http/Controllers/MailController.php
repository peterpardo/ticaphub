<?php

namespace App\Http\Controllers;

use App\Jobs\RegisterUserJob;
use App\Mail\InvitationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class MailController extends Controller
{
    public function sendInvitation(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $token = Str::random(200) . time();

        $email = $request->email;

        $admin = User::find(Auth::user()->id);

        $link = URL::temporarySignedRoute('set-password', now()->addDays(7), [
            'token' => $token, 
            'ticap' => $admin->ticap_id
        ]);

        $details = [
            'title' => 'Welcome to TICaP Hub',
            'body' => "Please click the button below to register",
            'link' => $link,
        ];

        DB::table('register_users')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        dispatch(new RegisterUserJob($email, $details));
        
        $request->session()->flash('msg', 'Email has been sent successfully');
        $request->session()->flash('status', 'green');
        return back();
    }

    public function sendMultipleInvitation(Request $request) {

        if($request->file){
            $data =  array_map('str_getcsv', file($request->file));
            unset($data[0]);

            DB::transaction(function() use ($data){
                foreach($data as $value) {
                    $email = $value[0];
                }
            });



            
            foreach($data as $value) {
                $email = $value[0];

                $token = Str::random(200) . time();

                $link = URL::temporarySignedRoute('register', now()->addDays(7), [$token]);

                $details = [
                    'title' => 'Welcome to TICaP Hub',
                    'body' => "Please click the button below to register",
                    'link' => $link,
                ];

                DB::table('register_users')->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                dispatch(new RegisterUserJob($email, $details));
            }
            
            $request->session()->flash('msg', 'Email has been sent successfully');
            $request->session()->flash('status', 'green');
            return back();
        }

        $request->session()->flash('status', 'Something went wrong! Try again.');
        $request->session()->flash('status', 'red');
        return back();
    }

    public function importUsers(Request $request) {
        $request->validate([
            'school' => 'required',
            'specialization' => 'required',
            'file' => 'required',
        ]);
        
        $file = $request->file('file');
        
        // $import = new UserImport($request->school, $request->specialization, );
        // $import->import($file);
   

        return back()->with('success', 'User Imported Successfully.');
    }
}
