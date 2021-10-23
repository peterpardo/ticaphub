<x-app-layout>
  <x-page-title>{{ $title }}</x-page-title>

  <div>
      <h1 class="text-center font-bold text-2xl">{{ $ticap }}</h1>
  </div>
<section>
    {{-- <!---===================== FIRST ROW CONTAINING THE  STATS CARD STARTS HERE =============================-->
<div class="flex flex-col justify-evenly lg:flex-row lg:w-full bg-gray-100 py-10 p-14 rounded">
<!---== First Stats Container ====--->
<div class="mt-6 sm:mt-5 md:mt-0 container mx-auto pr-4">
<div class="w-80 md:w-52 lg:w-auto bg-white max-w-xs mx-auto rounded-md overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
<div class="h-20 bg-red-400 flex items-center justify-between">
  <p class="mr-0 text-white text-lg pl-5">Lorem</p>
</div>
<div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
  <p>TOTAL</p>
</div>
<p class="py-4 text-3xl ml-5">20,456</p>
<!-- <hr > -->
</div>
</div>
<!---== First Stats Container ====--->

<!---== Second Stats Container ====--->
<div class="mt-6 sm:mt-5 md:mt-0 container mx-auto pr-4">
<div class="w-80 md:w-52 lg:w-auto bg-white max-w-xs mx-auto rounded-md overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
<div class="h-20 bg-red-700 flex items-center justify-between">
  <p class="mr-0 text-white text-lg pl-5">Lorem</p>
</div>
<div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
  <p>TOTAL</p>
</div>
<p class="py-4 text-3xl ml-5">19,694</p>
<!-- <hr > -->
</div>
</div>
<!---== Second Stats Container ====--->

<!---== Third Stats Container ====--->
<div class="mt-6 sm:mt-5 md:mt-0 container mx-auto pr-4">
<div class="w-80 md:w-52 lg:w-auto bg-white max-w-xs mx-auto rounded-md overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
<div class="h-20 bg-purple-400 flex items-center justify-between">
  <p class="mr-0 text-white text-lg pl-5">Lorem</p>
</div>
<div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
  <p>TOTAL</p>
</div>
<p class="py-4 text-3xl ml-5">711</p>
<!-- <hr > -->
</div>
</div>
<!---== Third Stats Container ====--->

<!---== Fourth Stats Container ====--->
<div class="mt-6 sm:mt-5 md:mt-0 container mx-auto pr-4">
<div class="w-80 md:w-52 lg:w-auto bg-white max-w-xs mx-auto rounded-md overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
<div class="h-20 bg-purple-400 flex items-center justify-between">
  <p class="mr-0 text-white text-lg pl-5">Lorem</p>
</div>
<div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
  <p>TOTAL</p>
</div>
<p class="py-4 text-3xl ml-5">711</p>
<!-- <hr > -->
</div>
</div>
<!---== Fourth Stats Container ====---> --}}
 <!-- Statistics Cards -->
 @if($user->hasRole('admin'))
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
  <div class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $students->count() }}</p>
    <p>Students</p>
  </div>
  </div>
  <div class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
    
  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $panelists->count() }}</p>
    <p>Panelist</p>
  </div>
  </div>
  <div class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <circle cx="9" cy="7" r="4"></circle>
      <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $officers->count() }}</p>
    <p>Officers</p>
  </div>
  </div>
  <div class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
    
  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $admins->count() }}</p>
    <p>Admins</p>
  </div>
  </div>
  </div>
  </section>
 @endif

{{-- SCHEDULES --}}
@if(!$user->hasRole('admin'))
  <h1 class="font-bold text-2xl">Schedules</h1>
  <div class="flex flex-col">
    <div class="mb-2">
      {{-- @if($user->schedules->count() == 0)
          <div class="bg-gray-100 text-center py-5 rounded">No scheduled events</div>
      @else --}}
          @foreach(\App\Models\Schedule::all() as $sched)
              <div class="p-2 my-1 shadow rounded relative">
                  <div>
                      <h1 class="text-xl font-semibold">{{ $sched->name }}</h1> 
                      <div class="text-gray-500">
                          <span class="block"><span class="font-semibold">Start Date: </span>{{ \Carbon\Carbon::parse($sched->start_date)->format('F j, Y')}}</span>  
                          <span class="block"><span class="font-semibold">End Date: </span>{{ \Carbon\Carbon::parse($sched->end_date)->format('F j, Y')}}</span>  
                          <span class="block"><span class="font-semibold">Attendees:</span>
                          <div class="divide-x-2 inline-block">
                              @foreach($sched->attendees as $attendee)
                                  <span class="inline-block pl-1">{{ $attendee->name }}</span>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      {{-- @endif --}}
    </div> 
  </div>
@endif


@if(session('status'))
  <div class="bg-{{ session('status') }}-500 py-5 rounded mb-2 text-white text-center">{{ session('message') }}</div>
@endif

@if($user->ticap_id == null)
  <div class="bg-gray-100 py-5 px-2 rounded text-gray-800 text-center">
    <span>No TICaP has been created yet: </span>
    <a href="{{ route('set-ticap-name') }}" class="inline-block text-white bg-green-500 hover:bg-green-600 px-5 py-2 rounded">Set TICaP</a>
  </div>
@else

{{-- FOR STUDENTS AND OFFICERS ONLY --}}
<!-- ./Statistics Cards -->
@if(!$user->hasRole('admin'))
  @if($user->committeeMember()->exists())
    @livewire('committee-notification', ['user' => $user])
  @elseif($user->hasRole('officer'))
    @livewire('task-notification', ['user' => $user])
  @endif
@endif

{{-- PROGRAM FLOW OF EVENTS --}}
<h1 class="font-bold text-2xl mb-3">Event Programs</h1>
@foreach ($events as $event)
<h1 class="font-semibold text-xl mb-1">{{ $event->name }}</h1>
@if(!$event->programFlows()->exists())
  <div class="bg-gray-100 text-center py-6 rounded text-gray-800">No Uploaded Program Flow</div>
@else
  <div class="flex flex-wrap justify-center">
    @foreach ($event->programFlows as $program)
      <div class="w-1/2">
        <img src="{{ Storage::url($program->path) }}" alt="{{ $program->name }}" class="w-full">
      </div>
    @endforeach  
  </div>
@endif
@endforeach
{{-- PROGRAM FLOW OF EVENTS --}}
@endif

</x-app-layout>
