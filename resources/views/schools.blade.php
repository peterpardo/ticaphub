<x-guest-layout>
  <div class="container mx-auto w-7/12">
      <h1 class="text-center text-5xl my-5 font-black">Schools</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 mx-auto justify-items-center">
        @foreach($schools as $school)
        <a href="/schools/{{ $school->id }}/specializations">
          <div class="w-72 bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
            <div class="overflow-x-hidden rounded-2xl relative">
                <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="{{url('/assets/ticap-logo.png')}}">                  
            </div>
            <div class="mt-4 pl-2 mb-2 flex justify-center">
                  <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">{{ $school->name }}</h1>
            </div>
          </div>
        </a> 
        @endforeach
      </div>
  </div>
</x-guest-layout>

{{-- BACKUP --}}
     {{-- <div class="cursor-pointer h-5/6 w-5/6 my-5 max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
              <div class="px-4 py-2 text-center">
                  <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">ITSMBA</h1>
              </div>

              <img class="object-cover w-full h-48 mt-2 hover:opacity-75" src="{{ asset('assets/SMBA.png') }}">
          </div> --}}