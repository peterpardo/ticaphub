<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Rubric;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{
    public function index() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if(!$ticap->invitation_is_set) {
            return redirect()->route('set-invitation');
        }
        $title = 'Project Assessment';
        $scripts = [
            asset('js/awards/addAward.js'),
        ];
        return view('awards.index', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }
    public function setRubrics() {
        $title = 'Project Assessment';
        $specializations = Specialization::all();
        $scripts = [
            asset('js/awards/set-rubric.js'),
        ];
        return view('awards.set-rubrics', [
            'title' => $title,
            'scripts' => $scripts,
            'specializations' => $specializations
        ]);
    }
    public function createRubric() {
        $title = 'Project Assessment';
        $scripts = [
            asset('js/awards/create-rubric.js'),
        ];
        return view('awards.create-rubric', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }
    public function addRubric(Request $request) {
        $request->validate([
            'name' => 'required',
            'criteria' => 'required',
            'percentages' => 'required',
        ]);
        $rubric = Rubric::create([
            'name' => $request->name
        ]);
        for($x = 0; $x < count($request->criteria); $x++) {
            Criteria::create([
                'name' => $request->criteria[$x],
                'percentage' => $request->percentages[$x],
                'rubric_id' => $rubric->id
            ]);
        }
        session()->flash('status', 'green');
        session()->flash('message', 'Rubric successfully created');
        return redirect()->route('set-rubrics');
    }
}
