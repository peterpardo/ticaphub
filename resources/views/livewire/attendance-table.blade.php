<div>
    <a href="/assessment-panel" class="bg-red-500 hover:bg-red-600 text-white rounded px-2 py-1">Back</a>

    <h1 class="font-semibold text-xl my-2 text-center">Attendance</h1>

    <input type="text" class="rounded mb-2" wire:model.debounce.150ms="search" placeholder="Search attendee">
    <table class="w-full">
        <thead>
            <tr>
                <td class="border text-xl bg-gray-100 font-semibold px-2 py-2">Name</td>
                <td class="border text-xl bg-gray-100 font-semibold px-2 py-2">Email</td>
                <td class="border text-xl bg-gray-100 font-semibold px-2 py-2">Event</td>
            </tr>
        </thead>
        <tbody>
            @foreach($attendees as $attendee)
                <tr>
                    <td class="border px-2 py-2">{{ $attendee->fname }} {{ $attendee->mname }} {{ $attendee->lname }}</td>
                    <td class="border px-2 py-2">{{ $attendee->email }}</td>
                    <td class="border px-2 py-2">{{ $attendee->event->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
