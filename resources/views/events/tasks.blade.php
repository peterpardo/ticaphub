<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <h1 class="text-center text-4xl font-bold mb-2">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">

        <h1 class="text-center text-3xl font-bold">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">

        {{-- ADD TASK - START --}}
        <div class="container shadow-md p-3 rounded mb-2">
            <h1 class="font-bold text-2xl my-3">Add Task</h1>

            {{-- MESSAGE STATUS --}}
            <div id="message"></div>

            <form id="addTaskForm" class="flex flex-col">
            @csrf

                
                <div class="my-2">
                    <label for="title" class="block font-semibold mb-2">Title</label>
                    <input class="rounded" type="text" name="title" id="title" autocomplete="off">
                </div>

                <div class="my-2 relative">
                    <label for="title" class="block font-semibold mb-2">Member</label>

                    <div class="relative">
                      <div id="memberError" class="text-red-500"></div>
                      <input type="text" name="member" id="member" autocomplete="off" class="rounded" placeholder="Search officer">
                      <div id="searchList" class="absolute bg-white rounded z-40 max-h-40 overflow-auto"></div>
                    </div>

                    {{-- TAG CONTAINER --}}
                    <div class="relative w-56">                
                        <div id="tagContainer"></div>
                    </div>
                </div>
                 
                <div class="my-2">
                    <label for="description" class="block font-semibold mb-2">Description</label>
                    <textarea id="description" class="resize-none w-1/2 h-40 rounded"></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Task</button>
                </div>
                
            </form>
        </div>
        {{-- ADD TASK - END --}}

        {{--(TEMPORARY TABLE)--}}
        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Created by</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>

                <tbody id="taskLists" class="bg-white text-center"></tbody>
            </table>
        </div>
        {{--(TEMPORARY TABLE)--}}
    </div>
</x-app-layout>