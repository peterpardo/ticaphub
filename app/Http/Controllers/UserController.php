<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Jobs\RegisterUserJob;
use App\Models\Election;
use App\Models\Event;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function setPasswordForm(Request $request)
    {
        // Check if token exists in the registered table
        $isInvited = true;
        if (!DB::table('register_users')->where('token', $request->token)->exists()) {
            $isInvited = false;
        }

        return view('user-accounts.set-password', [
            'token' => $request->token,
            'ticap' => $request->ticap,
            'email' => $request->email,
            'isInvited' => $isInvited,
        ]);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        // Check if email and token exists
        $user = DB::table('register_users')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->exists();

        // Throw error if user doesn't exists
        if (!$user) {
            return back()->with('error', 'Current doesn\'t match the expected account.');
        }

        // Delete registered token
        DB::table('register_users')->where('token', $request->token)->delete();

        // Verify email of user
        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'email_verified' => 1,
        ]);

        return redirect()->route('login')->with('status', 'Password has been saved');
    }

    public function viewProfile()
    {
        $user = User::find(auth()->user()->id);

        return view('view-profile', [
            'user' => $user
        ]);
    }
}
