<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    @if(session('status'))
        <div class="bg-{{ session('status') }}-500 text-center rounded py-5 text-white mb-2">{{ session('message') }}</div>
    @endif
    @can('add event')
    <div class="flex justify-between items-center w-full mb-2">
        {{-- ADD EVENT FORM --}}
        <form 
            action="/events/add-event"
            method="POST">
            @csrf
            <label for="event_name" class="block font-semibold">Event Name</label>
            <input class="rounded text-gray-800" type="text" name="event_name" id="event_name" autocomplete="off" placeholder="Ex: Webinar">
            <button type="submit" class="md:w-auto bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg hover:bg-green-500 dark:hover:bg-green-200">Add Event</button>
            @error('event_name')
            <div class="text-red-500 block">{{ $message }}</div>
            @enderror
        </form>
        {{-- ADD EVENT FORM --}}
        <div>
            <a href="/check-attendance" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 rounded text-white">Check Attendance</a>
        </div>
    </div>
    @endcan

    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Event</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">QR Code</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>
                <tbody class="w-auto bg-white text-center">
                    @foreach($events as $event)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">{{ $event->name }}</td>
                        <td class="px-4 py-3 border">{{ $event->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 border mx-auto">
                            {{-- <div class="w-1/2 mx-auto"> --}}
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate(url('/attendance/'. $event->id))) !!} " class="mx-auto">
                                <p class="text-center mt-1">{{ url('/attendance/'. $event->id) }}</p>
                            {{-- </div> --}}
                        </td>
                        <td class="px-4 py-3 border">
                            <a href="/download-qr-code/{{ $event->id }}" class="sm:w-auto w-32 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-green-500 hover:bg-green-600 rounded inline-block text-white px-2 py-1">Download QR Code</a>
                            <a href="/events/{{ $event->id }}" class="sm:w-auto w-32 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>
                            @can('delete event')
                                @if($event->name != 'Awardings' && $event->name != 'Project Exhibit')
                                <button id="modalBtn" data-id="{{ $event->id }}" class="sm:w-auto w-32 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 deleteEventBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>
                                @endif
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- DELETE EVENT MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
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

</x-app-layout>