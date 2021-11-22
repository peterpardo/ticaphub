<x-guest-layout>
  <div class="container mx-auto w-7/12 h-screen">
    <div class="grid grid-cols-1 md:grid-cols-2 mx-auto justify-items-center">
      @foreach($groups as $group)
      <div class="w-72 h-64 bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
          <div class="overflow-x-hidden rounded-2xl relative">
            <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="{{url('/assets/specialization.png')}}">
          </div>
          <div class="mt-4 pl-2 mb-2 flex justify-center ">
            <div class="text-center">
              <h1 class="text-base font-bold text-gray-800 uppercase dark:text-white">{{ $group->name }}</h1>
              <div class="text-center">
                @php
                  $admin = \App\Models\User::find(1);
                  $showExhibit = false;
                  if($admin->ticap_id) {
                    $ticap = \App\Models\Ticap::find($admin->ticap_id);
                    $showExhibit = $ticap->finalize_award;
                  }
                @endphp
                <a href="/group/{{ $group->id }}" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">View</a>
                @if(!$showExhibit )
                  <a href="/student-choice-award/{{ $group->id }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">Vote</a>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
  </div>
  </x-guest-layout>