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
        $events = Event::get();
        return view('schedules.index', [
            'title' => $title,
            'events' => $events
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

        $startTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('start_time'), 'Asia/Manila');
        $endTime = Carbon::parse($request->input('start_date') . ' ' . $request->input('end_time'), 'Asia/Manila');
        // putenv('GOOGLE_APPLICATION_CREDENTIALS=/path/to/service-account-credentials.json');
        // $client = new Client();
        // $client->useApplicationDefaultCredentials();
        // $client->setSubject('monditech123@gmail.com');

        if($startTime > $endTime) {
            session()->flash('status', 'red');
            session()->flash('message', 'end time is invalid.');
            return back();
        }
        
        $google_client = new \Google_Client();
        $google_client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json'));
        $google_client->setAccessType( 'offline' );
        $google_client->setSubject('monditech123@gmail.com');
        $google_client->setApplicationName("TICaP HUB");
        $google_client->setScopes([\Google_Service_Calendar::CALENDAR, \Google_Service_Calendar::CALENDAR_EVENTS]);
        $event = new Event;
        $event->name = $request->name;
        $event->startDateTime = $startTime;
        $event->endDateTime = $endTime;
        $event->addAttendee([
            'email' => 'peterpardo123@gmail.com'
        ]);
        $event->save();
        dd('stop');

        session()->flash('status', 'green');
        session()->flash('message', 'Schedule successfullly created');
        return redirect()->route('schedules');
    }
}
