<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google\Client;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class ScheduleController extends Controller
{
    public function index() {
        $title = 'Schedules';
        return view('schedules.index', [
            'title' => $title,
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
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        // dd($request->start_date->diffForHumans());
        // dd($request->all());
        $startTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('start_time'));
        $endTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('end_time'));
        // dd(date_format($startTime, 'F j Y'));
        dd(date_format(Carbon::tomorrow(), 'F j Y'));
        dd(Carbon::tomorrow());
        dd(date('Y-m-d H:i:s', strtotime($startTime)));


        if($startTime > $endTime) {
            session()->flash('status', 'red');
            session()->flash('message', 'end time is invalid.');
            return back();
        }

        // $event = new Event;
        // $event->name = $request->name;
        // $event->startDateTime = $startTime;
        // $event->endDateTime = $endTime;
        // // $event->addAttendee([
        // //     'email' => 'peterpardo123@gmail.com'
        // // ]);
        // $event->save('insertEvent', ['sendNotifications' => true]);
        // $event->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Schedule successfullly created');
        return redirect()->route('schedules');
    }
}
