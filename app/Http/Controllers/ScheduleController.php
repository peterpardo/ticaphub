<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Google\Client;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class ScheduleController extends Controller
{
    public function index() {
        $title = 'Schedules';
        $schedules = Schedule::all();
        return view('schedules.index', [
            'title' => $title,
            'schedules' => $schedules,
        ]);
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
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        if($startDate > $endDate) {
            session()->flash('status', 'red');
            session()->flash('message', 'End date is invalid.');
            return back()->withInput();
        }
        Schedule::create([
            'name' => $request->name,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
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
}
