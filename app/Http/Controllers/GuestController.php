<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
        return view('home');
    }

    public function schools($id = 1) {
        // Check if school is involved in current ticap
        if (is_null(School::where('id', $id)->where('is_involved', 1)->first())) {
            return redirect()->route('schools');
        }

        $schools = School::where('is_involved', 1)->get();
        $specializations = Specialization::select('id', 'name')->where('school_id', $id)->get();
        $isActive = $id;

        return view('schools', [
            'schools' => $schools,
            'specializations' => $specializations,
            'isActive' => $isActive
        ]);
    }

    public function specialization($id) {
         // Check if specialization exists
         if (is_null(Specialization::where('id', $id)->first())) {
            return redirect()->route('schools');
        }

        $specialization = Specialization::select('id', 'name', 'school_id')->where('id', $id)->with('school:id,name')->first();
        $groups = Group::where('specialization_id', $id)->get();

        return view('homepage.groupView', [
            'groups' => $groups,
            'specialization' => $specialization
        ]);
    }
}
