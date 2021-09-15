<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return view('auth.register', [
            'token' => $request->token,
            'ticap' => $request->ticap
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialization' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'student_number' => 'required|numeric|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ticap' => 'required',
            'school' => 'required',
        ]);

        DB::table('register_users')->where('token', $request->token)->delete();

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'student_number' => $request->student_number,
            'password' => Hash::make($request->password),
            'ticap_id' => $request->ticap,
        ]);

        $user->userProgram()->create([
            'school_id' => $request->school,
            'specialization_id' => $request->specialization,
        ]);

        $user->assignRole('student');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
