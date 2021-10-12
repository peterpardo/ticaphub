<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Group;
use App\Models\Rubric;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use App\Models\StudentChoiceVote;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AwardController extends Controller
{
    public function index() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if(!$ticap->invitation_is_set) {
            session()->flash('error', 'Manage settings for TICaP first');
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

    public function setPanelist() {
        $title = 'Project Assessment';
        $scripts = [
            asset('js/awards/set-panelist.js'),
        ];
        return view('awards.set-panelists', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function assignPanelist() {
        $title = 'Project Assessment';
        $specs = Specialization::all();
        $panelists = User::role('panelist')->get();
        $scripts = [
            asset('js/awards/add-panelist.js'),
        ];
        return view('awards.assign-panelists', [
            'title' => $title,
            'panelists' => $panelists,
            'specs' => $specs,
            'scripts' => $scripts,
        ]);
    }

    public function assign(Request $request) {
        $request->validate([
            'specialization' => 'required',
            'panelists.*' => 'required',
        ]);

        $spec = Specialization::find($request->specialization);
        foreach($request->panelists as $p) {
            if(SpecializationPanelist::where('user_id', $p)->exists()) {
                $user = User::find($p);
                session()->flash('status', 'red');
                session()->flash('message', $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' already assigned');
                return back();
            }
            $spec->panelists()->create([
                'user_id' => $p
            ]);
        }
        session()->flash('status', 'green');
        session()->flash('message', 'Panelist successfully set');
        return redirect('/set-panelist');
    }

    public function fetchPanelists() {
        $panelists = User::role('panelist')->get();
        return response()->json([
            'status' => 200,
            'panelists' => $panelists
        ]);
    }

    public function awardReview() {
        $title = 'Project Assessment';
        $specs = Specialization::all();
        return view('awards.award-review', [
            'title' => $title,
            'specs' => $specs
        ]);
    }

    public function confirmAwards() {
        $specs = Specialization::all();

        // CHECK IF AWARDS IS EMPTY
        foreach($specs as $spec) {
            if(!$spec->awards()->exists() || $spec->awards->count() == 0) {
                session()->flash('status', 'red');
                session()->flash('message', $spec->name . ' (' . $spec->school->name . ') has no awards set');
                return back();
            } else {
                // CHECK IF AWARD HAS A RUBRIC
                foreach($spec->awards as $award) {
                    if(!$award->awardRubric()->exists()) {
                        session()->flash('status', 'red');
                        session()->flash('message', $spec->name . ' (' . $spec->school->name . ') - ' . $award->name . ' has no rubric set');
                        return back();
                    }
                }
            }

            // CHECK IF SPECIALIZATION HAS PANELISTS (MIN. OF 2)
            if(!$spec->panelists()->exists() || $spec->panelists->count() < 2) {
                session()->flash('status', 'red');
                session()->flash('message', $spec->name . ' (' . $spec->school->name . ') - lacks panelist/s (min. of 2)');
                return back();
            }

            // CHECK IF EACH SPECIALIZATION HAS 2 OR MORE GROUPS
            if($spec->groups->count() < 2) {
                session()->flash('status', 'red');
                session()->flash('message', $spec->name . ' (' . $spec->school->name . ') - needs two or more capstone groups');
                return back();
            }

            // CHECK IF GROUPS HAS SET AN ADVISER
            foreach($spec->groups as $group) {
                if($group->adviser == null) {
                    session()->flash('status', 'red');
                    session()->flash('message', $spec->name . ' (' . $spec->school->name . ') - '. $group->name . ' has not yet set an adviser.');
                    return back();
                }
            }
        }

        Ticap::where('id', Auth::user()->ticap_id)->update(['awards_is_set' => 1]);
        return redirect()->route('assessment-panel');
    }

    public function assessmentPanel() {
        $ticap = Ticap::find(Auth::user()->ticap_id);

        if($ticap->finalize_award) {
            return redirect()->route('review-results');
        }
        if(!$ticap->awards_is_set) {
            return redirect()->route('awards');
        }

        $title = 'Project Assessment';
        $panelists = SpecializationPanelist::all();
        $specs = Specialization::all();
        $scripts = [
            asset('/js/awards/generate-results.js')
        ];

        return view('awards.assessment-panel', [
            'title' => $title,
            'panelists' => $panelists,
            'specs' => $specs,
            'scripts' => $scripts,
        ]);
    }
    
    public function generateResults() {
        $panelists = User::role('panelist')->get();
        $specs = Specialization::all();
        $gs = Group::all();
        foreach($panelists as $panelist) {
            if(!$panelist->specializationPanelist->is_done) {
                return back()->with('status', 'red');
                return back()->with('message', 'Some panelists are not yet done evaluating');
            }
        }
        foreach($gs as $g) {
            $g->awards()->detach();
        }
        // COMPUTATION OF GRADES
        foreach($specs as $spec) {
            echo '<strong>' . $spec->name . '</strong><br>';
            // CREATE BEST PROJECT ADVISER AWARD
            $bestAdviser = $spec->awards()->create([
                'name' => 'Best Project Adviser',
                'type' => 'individual',
                'school_id' => $spec->school->id,
                'ticap_id' => Auth::user()->ticap_id,
            ]);
            foreach($spec->awards->where('name', '!=', 'Best Project Adviser') as $award) {
                echo '<strong>' . $award->name . '</strong><br>';
                foreach($spec->groups as $group) {
                    echo $group->name . '<br>';
                    foreach($group->panelistGrades->where('award_id', $award->id) as $panelistGrade) {
                        echo 'panelist : '. $panelistGrade->user->first_name . ' ' . $panelistGrade->user->middle_name . ' ' . $panelistGrade->user->last_name . ' - ';
                        echo '<strong>' . $panelistGrade->total_grade . '</strong><br>';
                    }
                    $total = round($group->panelistGrades->where('award_id', $award->id)->avg('total_grade'), 3);
                    $group->awards()->attach($award->id, ['total_grade' => $total]);
                    echo '<strong>Total Average Grade : ' . $total . '</strong><br>';
                    echo '<br>';
                }
                // DETERMINE WINNERS FOR EACH AWARDS
                $winners = [];
                foreach($award->groups()->orderByPivot('total_grade', 'desc')->get() as $group) {
                    echo $group->name . ' - '. $group->pivot->total_grade . '<br>';
                    $winners[$group->id] = $group->pivot->total_grade;
                }

                $final = array_keys($winners, max($winners));
                echo '<strong>Winners: ';
                // SET WINNERS
                foreach($final as $winner) {
                    $group = $award->groups()->where('group_id', $winner)->first();
                    echo $group->name . '<br>';
                    if($award->type == 'individual') {
                        $award->individualWinners()->create([
                            'group_id' => $winner,
                        ]);
                    }
                    if($award->type == 'group') {
                        $award->groupWinners()->create([
                            'group_id' => $winner,
                        ]);
                        if($award->name == 'Best Capstone Project') {
                            echo 'Best Project Adviser - ' . $group->adviser . '<br><br>';
                            $awardee = $bestAdviser->individualWinners()->create([
                                'group_id' => $winner,
                            ]);
                            $awardee->name = $group->adviser;
                            $awardee->save();
                        }
                    }
                }
                echo '</strong>';
                echo '<br>';
            }
            echo '<br><br>';
        }
        
        echo 'STUDENT CHOICE AWARDS <br>';
        $specs = Specialization::all();
        foreach($specs as $spec) {
            $votes = [];
            echo $spec->name . '<br>';
            foreach($spec->groups as $group) {
                $count = StudentChoiceVote::where('group_id', $group->id)->count();
                $votes[$group->id] = $count;
            }
            $final = array_keys($votes, max($votes));
            foreach($final as $groupId) {
                echo $groupId . '<br>';
                $spec->studentChoiceAwards()->create([
                    'name' => 'Student Choice Award - ' . $spec->name,
                    'ticap_id' => Auth::user()->ticap_id,
                    'group_id' => $groupId,
                ]);
            }
        }

        Ticap::where('id', Auth::user()->ticap_id)->update(['finalize_award' => 1]);
        return redirect()->route('review-results');
    }

    public function reviewResults() {
        $title = 'Project Assessment';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $specs = Specialization::all();
        $scripts = [
            asset('/js/awards/finalize.js')
        ];
        return view('awards.review-results', [
            'title' => $title,
            'specs' => $specs,
            'ticap' => $ticap,
            'scripts' => $scripts,
        ]);
    }

    public function finalizeEvaluation() {
        $specs = Specialization::All();
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $withError = 0;
        foreach($specs as $spec){
            // RUNS IF SOME PANELISTS HASNT CHOSEN A USER
            if($spec->panelists()->where('has_chosen_user', 0)->exists()) {
                session()->flash('status', 'red');
                session()->flash('message', 'Some panelists still haven\'t chosen a winner.');
                return back();
            }
            // SET PANELIST TO HAS CHOSE USER (TESTING)
            // foreach($spec->panelists as $panelist) {
            //     $panelist->has_chosen_user = 1;
            //     $panelist->save();
            // }
            // dd();
            echo '<strong>' . $spec->name . '</strong><br>';
            foreach($spec->awards->where('type', 'individual')->where('name', '!=', 'Best Project Adviser') as $award) {
                echo '<strong>' . $award->name . '</strong><br>';
                foreach($award->individualWinners as $winner) {
                    if($winner->name == null) {
                        echo $winner->group->name . '<br>';
                        $user = []; 
                        foreach($winner->group->individualCandidates as $candidate) {
                            array_push($user, $candidate->user->id);
                        }
                        // LET PANELISTS VOTE AGAIN FOR INDIVIDUAL AWARDS IF THEY DIDNT CHOOSE THE SAME USER
                        if(count(array_unique($user)) > 1) {
                            echo 'more than 1 user<br>';
                            // UNDO LATER
                            $winner->group->individualCandidates()->delete();
                            foreach($spec->panelists as $panelist) {
                                $panelist->has_chosen_user = 0;
                                $panelist->save();
                            }
                            $withError = 1;
                        } else {
                            // SET INDIVIDUAL WINNER
                            $user = User::find($user[0]);
                            $winner->name = $user->first_name . ' ' . $user->middle_name . ' ' .  $user->last_name;
                            $winner->save();
                            $winner->group->individualCandidates()->delete();
                            echo 'winner : ' . $user[0] . '<br>';
                        }
                    }
                }
            }
            echo '<br>';
        }
        if($withError) {
            session()->flash('status', 'red');
            session()->flash('message', 'Some panelists picked different individual winners. Wait for panelists to choose again.');
            return back();
        } else {
            $ticap->evaluation_finished = 1;
            $ticap->save();
            session()->flash('status', 'green');
            session()->flash('message', 'Congratulations! Evaluation has successfully finished.');
            return back();
        }
    }

    public function generateAwards() {
        $data = [
            'specs' => Specialization::all(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.awards', $data);
        return $pdf->download(time().'-awardees.pdf');
    }

    public function generatePanelists() {
        $data = [
            'specs' => Specialization::all(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.panelists', $data);
        return $pdf->download(time().'-panelists.pdf');
    }

    public function generateGradedRubrics() {
        $data = [
            'specs' => Specialization::all(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.graded-rubrics', $data);
        return $pdf->download(time().'-graded-rubrics.pdf');
    }

    public function generateRubrics() {
        $data = [
            'specs' => Specialization::all(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.rubrics', $data);
        return $pdf->download(time().'-rubrics.pdf');
    }

    public function generateCertificates() {
        // dd('generate certificates');
        $data = [
            'specs' => Specialization::all(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.certificate', $data)->setPaper('a4', 'landscape');
        return $pdf->download(time().'-certificates.pdf');
    }
}
