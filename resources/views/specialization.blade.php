<x-guest-layout>
  <h1 class="text-center text-5xl my-5 font-black">Specializations</h1>
  <div class="w-7/12 mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 mx-auto justify-items-center sm:w-full">
        @foreach($specializations as $specialization)
          <a href="/specializations/{{ $specialization->id }}/groups">
            <div class="w-72 h-64 bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                <div class="overflow-x-hidden rounded-2xl relative">
                  <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="{{url('/assets/specialization.png')}}">                  
                </div>
                <div class="mt-3 flex justify-center items-end">
                  <div class="text-center">
                    <h1 class="justify-center text-base font-bold text-gray-800 uppercase dark:text-white">{{ $specialization->name }}</h1>
                  </div>
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