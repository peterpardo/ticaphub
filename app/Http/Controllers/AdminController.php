<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Specialization;
use Illuminate\Http\Request;

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
}
