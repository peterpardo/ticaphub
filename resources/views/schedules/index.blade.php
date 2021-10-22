<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    {{-- <a href="/schedules/create" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-2">Create Schedule/Event</a> --}}
    @if(session('status'))
        <div class="bg-{{ session('status') }}-300 rounded px-2 py-5 text-center text-white">{{ session('message') }}</div>
    @endif
    
    <div x-data="{open: false}">
        <div class="flex flex-col p-2">
            <div class="mb-2">
                <h1 class="font-semibold text-2xl">Today</h1>
                @if($schedules->where('start_date', \Carbon\Carbon::today())->count() == 0 || $schedules->where('end_date', \Carbon\Carbon::today())->count() == 0)
                    <div class="bg-gray-100 text-center py-5 rounded">No scheduled events</div>
                @else
                    @foreach($schedules as $sched)
                        <div class="p-2 ml-5 my-1 shadow rounded relative">
                            <div>
                                <h1 class="text-xl font-semibold">{{ $sched->name }}</h1> 
                                <div class="text-gray-500">
                                    <span class="block"><span class="font-semibold">Start Date: </span>{{ $sched->start_date->format('F j, Y') }}</span>  
                                    <span class="block"><span class="font-semibold">End Date: </span>{{ $sched->end_date->format('F j, Y') }}</span>   
                                    <span class="block"><span class="font-semibold">Attendees: </span>All users</span>  
                                </div>
                            </div>
                            <button @click="open=true" class="font-bold text-4xl hover:text-red-600 cursor-pointer text-red-500 absolute top-0 right-2">&times;</button>
                        </div>
                    @endforeach
                @endif
            </div> 
        </div>
        
        {{-- DELETE EVENT MODAL --}}
        <div x-cloak x-show="open" class="min-w-screen h-screen animated fadeIn faster flex fixed left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deletEventModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div @click.away="open = false" class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
                <!--content-->
                <div >
                    <form action="/schedules" method="post" id="deleteForm">
                        @csrf
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                                <p class="text-sm text-gray-500 px-8">Do you really want to delete the event? This process cannot be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                            <button @click.prevent="open = false" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                            <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- DELETE POSITION MODAL --}}
    </div>

</x-app-layout>