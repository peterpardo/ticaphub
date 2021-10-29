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

class ScheduleController extends Controller
{
    public function index() {
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
            asset('js/schedules/schedules.js'),
        ];

        return view('schedules.index', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function viewCalendar() {
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
        $schedules = Schedule::all();

        return $schedules;
    }

    public function createSchedule() {
        $title = 'Schedules';

        return view('schedules.create', [
            'title' => $title
        ]);
    }

    public function addSchedule(Request $request) {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $startDate = Carbon::parse($request->start_date . "23:59:59", 'Asia/Manila');
        $endDate = Carbon::parse($request->end_date . "23:59:59", 'Asia/Manila');

        if($startDate > $endDate) {
            session()->flash('status', 'red');
            session()->flash('message', 'End date is invalid.');
            return back()->withInput();
        }
        
        if($startDate < Carbon::now()) {
            session()->flash('status', 'red');
            session()->flash('message', 'Start date is invalid.');
            return back()->withInput();
        }

        $sched = Schedule::create([
            'name' => $request->name,
            'start_date' => $startDate,
            'end_date' => $endDate,
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
       
        // dd($request->all());
        // $startTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('start_time'));
        // $endTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('end_time'));
        // dd(date_format($startTime, 'F j Y'));
        // dd(date_format(Carbon::tomorrow(), 'F j Y'));
        // dd(Carbon::tomorrow());
        // dd(date('Y-m-d H:i:s', strtotime($startTime)));

        session()->flash('status', 'green');
        session()->flash('message', 'Schedule successfullly created');
        return redirect()->route('schedules');
    }

    public function editSchedule($schedId) {
        $title = 'Schedules';
        $sched = Schedule::find($schedId);
        return view('schedules.edit', [
            'title' => $title,
            'sched' => $sched
        ]);
    }

    public function updateSchedule(Request $request, $schedId) {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if($startDate > $endDate) {
            session()->flash('status', 'red');
            session()->flash('message', 'End date is invalid.');
            return back()->withInput();
        }
        
        if($startDate < Carbon::today()) {
            session()->flash('status', 'red');
            session()->flash('message', 'Start date is invalid.');
            return back()->withInput();
        }

        $sched = Schedule::find($schedId);
        $sched->name = $request->name;
        $sched->start_date = $request->start_date;
        $sched->end_date = $request->end_date;
        $sched->save();

        if($request->attendees != null) {
            $sched->users()->detach();
            $sched->attendees()->delete();

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

        session()->flash('status', 'green');
        session()->flash('message', 'Schedule successfullly updated');
        return redirect()->route('schedules');
    }
}
