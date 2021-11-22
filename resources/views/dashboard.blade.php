<x-app-layout :scripts="$scripts">
  <x-page-title>{{ $title }}</x-page-title>
  @if($ticap)
    <div>
      <h1 class="text-center font-bold text-2xl">{{ $ticap }}</h1>
    </div>
  @endif
<section>

@if(session('status'))
  <div role="alert">
    <div class="bg-{{ session('status') }}-500 text-white font-bold rounded-t px-4 py-2">
      Greetings,
    </div>
    <div class="text-center border border-t-0 border-{{ session('status') }}-400 rounded-b bg-{{ session('status') }}-100 px-4 py-3 text-{{ session('status') }}-700">
      <p class="font-bold">{{ session('message') }}</p>
    </div>
  </div>
@endif

 @if($user->hasRole('admin'))
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
  <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $students->count() }}</p>
    <p>Students</p>
  </div>
  </div>
  <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
  <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>

  </div>
  <div class="text-right">
    <p class="text-2xl">{{ $panelists->count() }}</p>
    <p>Panelist</p>
  </div>
  </div>
  <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
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
  <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
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

  <hr class="border-gray-300 border-2 rounded mb-3 bg-gray-200 dark:border-gray-600 dark:bg-gray-800">
 @endif

{{-- SCHEDULES --}}
@if(!$user->hasRole('admin'))
  <h1 class="font-bold text-2xl">Schedules</h1>
  <div class="flex flex-col">
    <div class="mb-2">
      @if($user->schedules->count() == 0)
      <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">No Scheduled Events</p>
      </div>
      @else
          @foreach(\App\Models\Schedule::all() as $sched)
              <div class="p-2 my-1 shadow rounded relative text-gray-800 bg-white">
                  <div>
                      <h1 class="text-xl font-semibold">{{ $sched->name }}</h1>
                      <div class="text-gray-500">
                          <span class="block"><span class="font-semibold">Date: </span>{{ \Carbon\Carbon::parse($sched->date . "23:59:59", "Asia/Manila")->format('F j, Y')}}</span>
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
        @endif
    </div>
  </div>
@endif

@if($user->ticap_id == null)
  <div x-data="setTicap()">
    <div class="text-gray-800 dark:text-white mt-6 text-center">
      <div class="font-semibold text-2xl mb-2">No TICaP created</div>
      <button @click.prevent="isOpen = true" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block text-white text-xl bg-green-500 hover:bg-green-600 px-5 py-2 rounded">Set TICaP</button>
    </div>

      {{-- SET TICAP MODAL --}}
      <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="isOpen">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                <form
                    action="/set-ticap"
                    method="post"
                >
                @csrf
                <!--body-->
                <div class="text-gray-800 text-center p-5 flex-auto justify-center">
                    <label class="block font-semibold text-2xl mb-3 text-gray-800">Set TICaP</label>
                    <input type="text" @keydown="showMessage = false; message = ''" x-model="ticap" class="rounded w-full text-center" placeholder="Enter TICaP name">
                    <div x-show="showMessage" x-text="message" class="mt-3 text-xs font-semibold leading-tight text-red-700 rounded-sm"></div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <button @click.prevent="closeModal()" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                        <button @click.prevent="addTicap()" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- SET TICAP MODAL --}}
  </div>
@else

{{-- FOR STUDENTS AND OFFICERS ONLY --}}
<!-- ./Statistics Cards -->
@if(!$user->hasRole('admin'))
  @if($user->committeeMember()->exists())
    @livewire('committee-notification', ['user' => $user])
  @elseif($user->hasAnyRole(['officer', 'chairman']))
    @livewire('task-notification', ['user' => $user])
  @endif
@endif

{{-- PROGRAM FLOW OF EVENTS --}}
  <h1 class="font-bold text-2xl mb-3">Events</h1>
    <div class="flex flex-col">
      @foreach ($events as $event)
        <div class="mb-3">
          <div class="text-center bg-red-700 dark:bg-gray-800 shadow-lg rounded-md p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
            <h1 class="text-2xl font-semibold">{{ $event->name }}</h1>
          </div>
          <div class="px-2 py-5 rounded-b-2xl border bg-transparent dark:bg-gray-800 shadow-lg rounded-md p-3 border-b-4 border-red-800 dark:border-gray-600 text-gray-800 dark:text-white font-medium group">
            @if($event->programFlow)
              <h1 class="font-semibold text-xl mb-2">{{ $event->programFlow->title }}</h1>
              <p class="pl-4 mb-2">{{ $event->programFlow->description }}</p>

              <hr class="border bg-gray-200 border-gray-200 mb-2">

              <div class="flex w-full flex-wrap justify-evenly">
                @foreach ($event->programs as $program)
                  @if ($program->name == 'assets/program-flow-sample')
                    <a href="{{ asset(url($program->path)) }}" class="block w-1/2 flex-grow mb-2" data-featherlight="image">
                      <img class="w-full rounded" src="{{ asset(url($program->path)) }}" alt="{{ $program->name }}">
                    </a>
                  @else
                    <a href="{{ Storage::url($program->path) }}" class="block w-1/2 flex-grow mb-2" data-featherlight="image">
                      <img class="w-full rounded" src="{{ Storage::url($program->path) }}" alt="{{ $program->name }}">
                    </a>
                  @endif
                @endforeach
              </div>
            @else
              <p class="py-3 text-center">No posts</p>
            @endif
          </div>
        </div>
      @endforeach
    </div>


@endif
 {{-- @foreach ($event-> as $program)
                <div class="">
                  @if ($program->name == 'assets/program-flow-sample')
                  <a href="{{ asset(url($program->path)) }}" data-featherlight="image">
                    <img class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 mb-5 w-full h-64 object-cover object-center block rounded" src="{{ asset(url($program->path)) }}" alt="{{ $program->name }}">
                  </a>
                  @else
                  <a href="{{ Storage::url($program->path) }}" data-featherlight="image">
                    <img class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 mb-5 w-full h-64 object-cover object-center block rounded" src="{{ Storage::url($program->path) }}" alt="{{ $program->name }}">
                  </a>
                  @endif
                </div>
              @endforeach --}}

{{-- BACKUP --}}

{{-- @foreach ($event->programFlows as $program)
<div class="w-1/2">
  @if ($program->name == 'assets/program-flow-sample')
    <img src="{{ asset(url($program->path)) }}" alt="{{ $program->name }}" class="w-full">
  @else
    <img src="{{ Storage::url($program->path) }}" alt="{{ $program->name }}" class="w-full">
  @endif
</div>
@endforeach --}}

</x-app-layout>
