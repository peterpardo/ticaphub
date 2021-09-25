<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <div>
        <a href="/events" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-4xl font-bold">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">
        {{-- ADD LIST FORM--}}
        @can('add list')
        <div class="container p-3 rounded mb-2">
            <form 
            action="/events/{{ $event->id }}/add-list"
            method="POST">
            @csrf
                <h1 class="font-bold text-2xl my-3">Create List</h1>
                <label for="title" class="font-semibold mb-2 block">Title</label>
                <input class="rounded" type="text" name="title" id="title">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add List</button>
                @error('title')
                    <span class="text-red-500 block">{{ $message }}</span>
                @enderror
                @if(session('status'))
                    <div class="text-{{ session('status') }}-500 block">{{ session('message')}}</div>
                @endif
            </form>
        </div>
        @endcan
        {{-- ADD LIST FORM--}}

        {{-- KANBAN LAYOUT (TEMPORARY TABLE)--}}
        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">List</th>
                        <th class="px-4 py-3">Created By</th>
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Specialization</th>
                        <th class="px-4 py-3">Position</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>
                <tbody class="bg-white text-center">
                    @if($event->lists == null)
                    <div class="text-red-500 text-center mb-2">No List Created Yet</div>
                    @else
                        @foreach($event->lists as $list)
                        <tr>
                            <td class="px-4 py-3 border">{{ $list->title }}</td>
                            <td class="px-4 py-3 border">{{ $list->user->first_name }} {{ $list->user->middle_name }} {{ $list->user->last_name }}</td>
                            <td class="px-4 py-3 border">{{ $list->user->school->name }}</td>
                            <td class="px-4 py-3 border">
                                @if($list->user->hasRole('admin'))
                                    Faculty
                                @else
                                {{ $list->user->userSpecialization->specialization->name }}
                                @endif
                            </td>
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
                    @endif
                </tbody>
            </table>
        </div>
        {{-- KANBAN LAYOUT (TEMPORARY TABLE)--}}
    </div>

    {{-- DELETE LIST MODAL --}}
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
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the list? The process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <form 
                        action="/events/{{ $event->id }}/delete-list"
                        method="POST"
                        id="deleteListForm">
                        @csrf
                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE LIST MODAL --}}
</x-app-layout>