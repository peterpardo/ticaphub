<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Group;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PanelistController extends Controller
{
    public function index() {
        $title = 'Evaluate Capstone Groups';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $user = User::find(Auth::user()->id);

        if(!$ticap->awards_is_set) {
            return redirect()->route('dashboard');
        }
        if($user->specializationPanelist->is_done) {
            return redirect()->route('set-individual-awards');
        }
        if($user->specializationPanelist->evaluation_review) {
            return redirect()->route('review-grades');
        }
        if($user->specializationPanelist->update_evaluation) {
            return redirect()->route('change-grades');
        }

        return view('panelist.evaluate', [
            'title' => $title,
            'user' => $user,
            'ticap' => $ticap,
        ]);
    }

    public function computeGrades(Request $request) {
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'awards.*.*.*' => 'required',
        ], [
            'awards.*.*.*.required' => 'This field has no grade yet.' 
        ]);
        foreach(Group::all() as $group) {
            $group->awards()->detach();
        }
        foreach($request->awards as $awardId => $groups) {
            $award = Award::find($awardId);
            echo 'AWARD - ' . $award->name . '<br>';
            foreach($groups as $groupId => $grades) {
                $group = Group::find($groupId);
                $totalGrade = 0;
                echo 'GROUP - ' . $group->name . '<br>';
                foreach($award->awardRubric->rubric->criteria as $crit) {
                    $validator->after(function ($validator) use($grades, $crit, $award, $groups, $request){
                        foreach($request->awards as $awardId => $groups) {
                            $award = Award::find($awardId);
                            foreach($groups as $groupId => $grades) {
                                $group = Group::find($groupId);
                                foreach($award->awardRubric->rubric->criteria as $crit){
                                    if ($grades[$crit->id] > $crit->percentage) {
                                        $validator->errors()->add(
                                            'awards.' . $award->id . '.' . $group->id. '.' . $crit->id, 'input grade exceeds ' . $crit->percentage . '%'
                                        );
                                    }
                                }
                            }
                        }
                    });
                    if($validator->fails()) {
                        return redirect('evaluate-groups')->withErrors($validator)->withInput();
                    }
                    $group->groupGrades()->create([
                        'criteria_id' => $crit->id,
                        'grade' => $grades[$crit->id],
                        'award_id' => $award->id,
                    ]);
                    $totalGrade += $grades[$crit->id];
                }
                foreach($group->groupGrades as $groupGrade) {
                    echo $groupGrade->criteria->name . ' - ' . $groupGrade->grade . '<br>';
                }
                echo '<br>';
                $group->awards()->attach($award->id);
                echo 'Total Grade: ' . $totalGrade . '<br>';
                echo 'Initial grade: ' . $group->awards()->where('award_id', $award->id)->first()->pivot->total_grade;
                $group->awards()->updateExistingPivot($award->id, ['total_grade' => $totalGrade]);
                echo '<br>Final Grade: ' . $group->awards()->where('award_id', $award->id)->first()->pivot->total_grade . '<br><br>';
            }
        }
        $user->specializationPanelist->evaluation_review = 1;
        $user->specializationPanelist->save();
        return redirect()->route('review-grades');
    }

    public function reviewGrades() {
        $title = 'Evaluate Capstone Groups';
        $user = User::find(Auth::user()->id);
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $scripts = [
            asset('/js/panelists/confirm-grades.js')
        ];

        if($user->specializationPanelist->is_done) {
            return redirect()->route('set-individual-awards');
        }
        if($user->specializationPanelist->update_evaluation) {
            return redirect()->route('change-grades');
        }
        if(!$user->specializationPanelist->evaluation_review) {
            return redirect()->route('evaluate-groups');
        }

        return view('panelist.evaluation-review', [
            'title' => $title,
            'user' => $user,
            'ticap' => $ticap,
            'scripts' => $scripts,
        ]);
    }

    public function submitGrades() {
        $user = User::find(Auth::user()->id);
        $user->specializationPanelist->is_done = 1;
        $user->specializationPanelist->save();

        return redirect()->route('set-individual-awards');
    }

    public function changeGrades() {
        $title = 'Evaluate Capstone Groups';
        $user = User::find(Auth::user()->id);
        $ticap = Ticap::find(Auth::user()->ticap_id);

        if($user->specializationPanelist->is_done) {
            return redirect()->route('set-individual-awards');
        }
        if(!$user->specializationPanelist->evaluation_review) {
            if(!$user->specializationPanelist->update_evaluation) {
                return redirect()->route('evaluate-groups');
            }
        }
        if($user->specializationPanelist->evaluation_review) {
            $user->specializationPanelist->evaluation_review = 0;
            $user->specializationPanelist->update_evaluation = 1;
            $user->specializationPanelist->save();
        }

        return view('panelist.change-grades', [
            'title' => $title,
            'user' => $user,
            'ticap' => $ticap,
        ]);
    }

    public function updateGrades(Request $request) {
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'awards.*.*.*' => 'required',
        ], [
            'awards.*.*.*.required' => 'This field has no grade yet.' 
        ]);
        foreach($request->awards as $awardId => $groups) {
            $award = Award::find($awardId);
            echo 'AWARD - ' . $award->name . '<br>';
            foreach($groups as $groupId => $grades) {
                $group = Group::find($groupId);
                $totalGrade = 0;
                echo 'GROUP - ' . $group->name . '<br>';
                foreach($award->awardRubric->rubric->criteria as $crit) {
                    $validator->after(function ($validator) use($grades, $crit, $award, $groups, $request){
                        foreach($request->awards as $awardId => $groups) {
                            $award = Award::find($awardId);
                            foreach($groups as $groupId => $grades) {
                                $group = Group::find($groupId);
                                foreach($award->awardRubric->rubric->criteria as $crit){
                                    if ($grades[$crit->id] > $crit->percentage) {
                                        $validator->errors()->add(
                                            'awards.' . $award->id . '.' . $group->id. '.' . $crit->id, 'input grade exceeds ' . $crit->percentage . '%'
                                        );
                                    }
                                }
                            }
                        }
                    });
                    if($validator->fails()) {
                        return redirect('change-grades')->withErrors($validator)->withInput();
                    }
                    $group->groupGrades()->where('criteria_id', $crit->id)->where('award_id', $award->id)->update([
                        'grade' => $grades[$crit->id],
                    ]);
                    $totalGrade += $grades[$crit->id];
                }
                foreach($group->groupGrades as $groupGrade) {
                    echo $groupGrade->criteria->name . ' - ' . $groupGrade->grade . '<br>';
                }
                echo '<br>';
                echo 'Total Grade: ' . $totalGrade . '<br>';
                echo 'Initial grade: ' . $group->awards()->where('award_id', $award->id)->first()->pivot->total_grade;
                $group->awards()->updateExistingPivot($award->id, ['total_grade' => $totalGrade]);
                echo '<br>Final Grade: ' . $group->awards()->where('award_id', $award->id)->first()->pivot->total_grade . '<br><br>';
            }
        }
        $user->specializationPanelist->evaluation_review = 1;
        $user->specializationPanelist->update_evaluation = 0;
        $user->specializationPanelist->save();
        return redirect()->route('review-grades');
    }

    public function setIndividualAwards() {
        $title = 'Evaluate Capstone Groups';
        $user = User::find(Auth::user()->id);
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $panelists = SpecializationPanelist::where('specialization_id', $user->specializationPanelist->specialization->id)->get();
        $spec = Specialization::find($user->specializationPanelist->specialization->id);
        
        if(!$user->specializationPanelist->is_done) {
            return redirect()->route('dashboard');
        }

        return view('panelist.set-individual-awards', [
            'title' => $title,
            'user' => $user,
            'ticap' => $ticap,
            'panelists' => $panelists,
            'spec' => $spec,
        ]);
    }

    public function setAward(Request $request) {
        $validator = Validator::make($request->all(), [
            'group.*' => 'required'
        ],  [
            'group.*.required' => 'This field has no input yet.' 
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        dd('stop');
    }
}
