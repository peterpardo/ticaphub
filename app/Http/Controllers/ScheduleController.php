<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Ticap;
use App\Models\User;
use Carbon\Carbon;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Acaronlex\LaravelCalendar\Calendar;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index() {
        if(Auth::user()->ticap_id == null) {
            session()->flash('status', 'red');
            session()->flash('message', 'Set TICaP first');
            return redirect()->route('dashboard');
        }
        
        $ticap = Ticap::find(Auth::user()->ticap_id);
        
        if(!$ticap->invitation_is_set) {
            session()->flash('error', 'Manage settings for TICaP first');
            return redirect()->route('set-invitation');
        }

        if(Auth::user()->ticap_id == null) {
            session()->flashh('status', 'red');
            session()->flashh('message', 'Create TICaP first.');
            return redirect()->route('dashboard');
        }

        $title = 'Schedules';
        $scripts = [
            asset('js/schedules/calendar.js'),
        ];

        return view('schedules.calendar', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function getSchedules() {
        $schedules = Schedule::with(['attendees'])->get();

        return $schedules;
    }


    public function addSchedule(Request $request) {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required',
            'event_date' => 'required',
            'event_theme' => 'required',
        ]);

        $date = Carbon::parse($request->event_date . "23:59:59", 'Asia/Manila');

        if($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ]);
        }

        $sched = Schedule::create([
            'name' => $request->event_title,
            'date' => $date,
            'theme' => $request->event_theme
        ]);

        if($request->attendees != null) {
            foreach($request->attendees as $attendee) {
                $sched->attendees()->create([
                    'name' => $attendee
                ]);

                if($attendee == 'panelists') {
                    $panelists = User::role('panelist')->get();
                    foreach($panelists as $panelist) {
                        $sched->users()->attach($panelist->id);
                    }
                }
                if($attendee == 'students') {
                    $students = User::role('student')->get();
                    foreach($students as $student) {
                        $sched->users()->attach($student->id);
                    }
                }
                if($attendee == 'officers') {
                    $officers = User::role(['officer', 'chairman'])->get();
                    foreach($officers as $officer) {
                        $sched->users()->attach($officer->id);
                    }
                }
            }
        }

        return response([
            'success' => 'Schedule successfully created.'
        ]);
    }

    public function deleteSchedule($id) {
        Schedule::find($id)->delete();

        return response([
            'success' => 'Schedule successfully deleted.'
        ]);
    }

    // public function editSchedule($schedId) {
    //     $title = 'Schedules';
    //     $sched = Schedule::find($schedId);
    //     return view('schedules.edit', [
    //         'title' => $title,
    //         'sched' => $sched
    //     ]);
    // }

    public function updateSchedule(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required',
            'event_date' => 'required',
            'event_theme' => 'required',
        ]);

        $date = Carbon::parse($request->event_date . "23:59:59", 'Asia/Manila');

        if($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ]);
        }

        $sched = Schedule::find($id);
        $sched->name = $request->event_title;
        $sched->date = $date;
        $sched->theme = $request->event_theme;
        $sched->save();

        if($request->attendees != null) {
            $sched->attendees()->delete();
            $sched->users()->detach();
            foreach($request->attendees as $attendee) {
                $sched->attendees()->create([
                    'name' => $attendee
                ]);

                if($attendee == 'panelists') {
                    $panelists = User::role('panelist')->get();
                    foreach($panelists as $panelist) {
                        $sched->users()->attach($panelist->id);
                    }
                }
                if($attendee == 'students') {
                    $students = User::role('student')->get();
                    foreach($students as $student) {
                        $sched->users()->attach($student->id);
                    }
                }
                if($attendee == 'officers') {
                    $officers = User::role(['officer', 'chairman'])->get();
                    foreach($officers as $officer) {
                        $sched->users()->attach($officer->id);
                    }
                }
            }
        }

        return response([
            'success' => 'Schedule successfully updated.'
        ]);
    }
}
