<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    {{-- <a href="/schedules/create" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-2">Create Schedule/Event</a> --}}
    @if(session('status'))
        <div class="bg-{{ session('status') }}-300 rounded px-2 py-5 text-center text-white">{{ session('message') }}</div>
    @endif
    <table class="w-full table-fixed mt-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-1 border font-semibold">Agenda</td>
                <td class="bg-gray-100 px-2 py-1 border font-semibold">Start Date Time</td>
                <td class="bg-gray-100 px-2 py-1 border font-semibold">End Date Time</td>
                <td class="bg-gray-100 px-2 py-1 border font-semibold">Action</td>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($events as $event)
            <tr>
                <td class="px-2 py-4 border">{{ $event->name }}</td>
                <td class="px-2 py-4 border">{{$event->startDateTime->diffForHumans() }}</td>
                <td class="px-2 py-4 border">{{$event->endDateTime->diffForHumans() }}</td>
                <td class="px-2 py-4 border text-center">
                    <a href="/schedules/{{ $event->id }}" class="inline-block px-2 py-1 bg-blue-500 rounded text-white">Edit</a>
                    <button data-id="{{ $event->id }}" class="openDeleteModal px-2 py-1 bg-red-500 rounded text-white">Delete</button>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>

    {{-- DELETE EVENT MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deletEventModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
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
                        <button id="closeDeleteModal" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- DELETE POSITION MODAL --}}
</x-app-layout>