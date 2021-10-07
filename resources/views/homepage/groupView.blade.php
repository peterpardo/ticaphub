<x-guest-layout>
  <div class="container mx-auto w-8/12 my-5">
    <div class="grid grid-cols-1 md:grid-cols-2 mx-auto justify-items-center">
      @foreach($groups as $group)
      <div class="w-72 h-64 bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
          <div class="overflow-x-hidden rounded-2xl relative">
            <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="{{url('/assets/ticap-logo.png')}}">                  
          </div>
          <div class="mt-4 pl-2 mb-2 flex justify-center ">
            <div class="text-center">
              <h1 class="text-base font-bold text-gray-800 uppercase dark:text-white">{{ $group->name }}</h1>
              <div class="text-center">
                <a href="/group/{{ $group->id }}" class="inline-block rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">View</a>
                <a href="#" class="my-5 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Vote</a>
              </div>
            </div>
          </div>
        </div>   
        @endforeach
      </div>
  </div>
  </x-guest-layout>
  
  {{-- backup --}}
  
   {{-- <div class="grid grid-cols-1 sm:grid-cols-2 w-auto md:w-9/12 mx-auto">
      <div class="p-8 w-full">
          <div class="shadow-xl rounded-lg">
            <div style="background-image: url('https://images.pexels.com/photos/814499/pexels-photo-814499.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260')" class="h-64 bg-gray-200 bg-cover bg-center rounded-t-lg flex items-center justify-center"> 
              <p class="text-white font-bold text-4xl">CYBERACE</p>
            </div>
              <div class="bg-white rounded-b-lg px-8 flex justify-around mx-auto">
                  <a
                    class="my-5 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                      View
                  </a>
                  <a
                  class="my-5 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
                    Vote
                </a>
              </div>
          </div>
        </div>
  
      <div class="p-8 w-full">
          <div class="shadow-xl rounded-lg">
            <div style="background-image: url('https://images.pexels.com/photos/814499/pexels-photo-814499.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260')" class="h-64 bg-gray-200 bg-cover bg-center rounded-t-lg flex items-center justify-center"> 
              <p class="text-white font-bold text-4xl">LSMR</p>
            </div>
              <div class="bg-white rounded-b-lg px-8 flex justify-around mx-auto">
                  <a
                    class="my-5 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                      View
                  </a>
                  <a
                  class="my-5 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
                    Vote
                </a>
              </div>
          </div>
        </div>
  
        <div class="p-8 w-full">
          <div class="shadow-xl rounded-lg">
            <div style="background-image: url('https://images.pexels.com/photos/814499/pexels-photo-814499.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260')" class="h-64 bg-gray-200 bg-cover bg-center rounded-t-lg flex items-center justify-center"> 
              <p class="text-white font-bold text-4xl">ALTWAV</p>
            </div>
              <div class="bg-white rounded-b-lg px-8 flex justify-around mx-auto">
                  <a
                  class="my-5 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                      View
                  </a>
                  <a
                  class="my-5 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
                    Vote
                </a>
              </div>
            </div>
          </div>
  
        <div class="p-8 w-full">
          <div class="shadow-xl rounded-lg">
            <div style="background-image: url('https://images.pexels.com/photos/814499/pexels-photo-814499.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260')" class="h-64 bg-gray-200 bg-cover bg-center rounded-t-lg flex items-center justify-center"> 
              <p class="text-white font-bold text-4xl">BITS & BYTES</p>
            </div>
              <div class="bg-white rounded-b-lg px-8 flex justify-around mx-auto">
                  <a
                    class="my-5 rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                      View
                  </a>
                  <a
                  class="my-5 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
                    Vote
                </a>
              </div>
            </div>
          </div>
        </div> --}}