<div>
    <a href="/assessment-panel" class="bg-red-500 hover:bg-red-600 text-white rounded px-2 py-1">Back</a>

    <h1 class="font-semibold text-xl my-2 text-center">Attendance</h1>

    @if($attendees->count() == 0)
        <div class="bg-gray-100 text-center rounded py-5 my-1">No Attendees</div>
    @else
        <input type="text" class="rounded mb-2" wire:model.debounce.150ms="search" placeholder="Search attendee">
        <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Name</td>
                            <th class="px-4 py-3">Email</td>
                            <th class="px-4 py-3">Event</td>
                        </tr>
                    </thead>
                    <tbody class="w-auto bg-white text-center">
                        @foreach($attendees as $attendee)
                            <tr class="text-gray-800">
                                <td class="border px-2 py-2">{{ $attendee->fname }} {{ $attendee->mname }} {{ $attendee->lname }}</td>
                                <td class="border px-2 py-2">{{ $attendee->email }}</td>
                                <td class="border px-2 py-2">{{ $attendee->event->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
