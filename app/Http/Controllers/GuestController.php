<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupExhibit;
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
        $specialization = Specialization::select('id', 'name', 'school_id')->where('id', $id)->with('school:id,name')->first();

        // Check if specialization exists
        if (is_null($specialization)) {
            return redirect()->route('schools');
        }

        $groups = Group::where('specialization_id', $id)->get();

        return view('homepage.groupView', [
            'groups' => $groups,
            'specialization' => $specialization
        ]);
    }

    public function group($id) {
        // Get details of group
        $groupExhibit = GroupExhibit::where('group_id', $id)->with('group:id,name')->first();

        // Check if group exists
        if (is_null($groupExhibit)) {
            return redirect()->route('schools');
        }

        return view('homepage.viewSpecialization', ['groupExhibit' => $groupExhibit]);
    }
}
