<x-app-layout :scripts="$scripts">
    {{-- <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div>
        <a href="/events" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-4xl font-bold mb-1">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">
        @can('add list')
            <div class="w-full p-3 rounded mb-2">
                <form 
                action="/events/{{ $event->id }}/add-list"
                method="POST">
                @csrf
                    @if(session('status'))
                        <div class="bg-{{ session('status') }}-500 text-center py-5 rounded text-white block my-1">{{ session('message') }}</div>
                    @endif
                    <h1 class="font-bold text-2xl my-3">Create List</h1>
                    <label for="title" class="font-semibold mb-2 block">Title</label>
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <div>
                                <input class="rounded text-gray-800" type="text" name="title" id="title">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add List</button>
                            </div>
                            @error('title')
                                <span class="inline-block mt-2 bg-red-500 text-white rounded px-2 py-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <a href="/events/{{ $event->id }}/program-flow" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Upload Program Flow</a>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
        @if($event->lists->count() == 0)
            <div class="bg-gray-100 text-center py-5 rounded">No Lists created</div>
        @else
            <div class="w-full">
                <table class="w-full shadow text-gray-800">
                    <thead>
                        <tr class="bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">List</th>
                            <th class="px-4 py-3">Created By</th>
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>   
                    </thead>
                    <tbody class="bg-white text-center">
                        @foreach($event->lists as $list)
                        <tr>
                            <td class="px-4 py-3 border">{{ $list->title }}</td>
                            <td class="px-4 py-3 border">{{ $list->user->first_name }} {{ $list->user->middle_name }} {{ $list->user->last_name }}</td>
                            <td class="px-4 py-3 border">
                                @if($list->user->hasRole('admin'))
                                    Faculty
                                @else
                                {{ $list->user->officer->position->name }}
                                @endif
                            </td>
                            <td class="px-4 py-3 border">
                                <a href="/events/{{ $event->id }}/list/{{ $list->id }}" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>
                                @can('delete list')
                                <button id="modalBtn" data-id="{{ $list->id }}" class="deleteListBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div> --}}
    @livewire('kanban', ['event' => $event])
</x-app-layout>