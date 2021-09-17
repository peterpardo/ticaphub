<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <h1 class="text-center text-4xl font-bold">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">

        {{-- ADD LIST - START --}}
        <div class="container shadow-md p-3 rounded mb-2">
            <form id="addListForm">
            @csrf

                <h1 class="font-bold text-2xl my-3">Add List</h1>
                {{-- MESSAGE STATUS --}}
                <div id="message"></div>
                <div class="my-2">
                    <label for="title" class="font-semibold mb-2">Title</label>
                    <input class="rounded" type="text" name="title" id="title">
                </div>
                
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add List</button>

            </form>
        </div>
        {{-- ADD LIST - END --}}

        {{-- KANBAN LAYOUT (TEMPORARY TABLE)--}}
        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">List</th>
                        <th class="px-4 py-3">Created By</th>
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Specialization</th>
                        <th class="px-4 py-3">No. of Tasks</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>

                <tbody class="bg-white text-center"></tbody>
            </table>
        </div>
        {{-- KANBAN LAYOUT (TEMPORARY TABLE)--}}
    </div>
</x-app-layout>