<x-app-layout :scripts="$scripts">
    {{-- <x-page-title>
        {{ $title }}
    </x-page-title> --}}

    <div>
        {{-- MESSAGE STATUS --}}
        @if(session('status'))
            <div class="text-{{ session('status') }}-500 mb-2">{{ session('message') }}</div>
        @endif
        
        @can('add event')
        <div class="container mb-2">
            <h1 class="font-bold text-3xl my-3">Create Event</h1>

            {{-- ADD EVENT FORM --}}
            <form 
                action="/events/add-event"
                method="POST"
               >
                @csrf

                <label for="event_name" class="block font-semibold mb-2">Event Name</label>

                {{-- ERROR MESSAGE --}}
                @error('event_name')
                <span class="text-red-500 block">{{ $message }}</span>
                @enderror

                <input class="rounded" type="text" name="event_name" id="event_name" autocomplete="off" placholder="Ex: Webinar">

                <button type="submit" class="md:w-auto bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">Add Event</button>
            </form>
            {{-- ADD EVENT FORM --}}

        </div>
        @endcan

        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Event</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>
                <tbody class="bg-white text-center">
                    @foreach($events as $event)
                    <tr>
                        <td class="px-4 py-3 border">{{ $event->name }}</td>
                        <td class="px-4 py-3 border">{{ $event->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 border">
                            <a href="/events/{{ $event->id }}" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>
                            @can('delete event')
                            <button id="modalBtn" data-id="{{ $event->id }}" class="deleteEventBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- DELETE EVENT MODAL --}}
        <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
        
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>

                        <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>

                        <p class="text-sm text-gray-500 px-8">Do you really want to delete the event? The process cannot be undone</p>

                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">

                        <form id="deleteEventForm">
                            @csrf

                            <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                            
                            <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        {{-- DELETE EVENT MODAL --}}
    </div>
</x-app-layout>