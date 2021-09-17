<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        @can('add events')
        <div class="container mb-2">
            <h1 class="font-bold text-3xl my-3">Create Event</h1>

            <form id="addEventForm">
                @csrf
                
                <label for="event_name" class="block font-semibold mb-2">Event Name</label>
                {{-- MESSAGE STATUS --}}
                <div id="message"></div>
                <input class="rounded" type="text" name="event_name" id="event_name">

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add event</button>
            </form>
        </div>
        @endcan

        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Event</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Updated At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>
                <tbody class="bg-white text-center"></tbody>
            </table>
        </div>
    </div>
</x-app-layout>