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
                    <input class="rounded" type="text" name="title" id="title">
                </div>

                <div class="my-2 relative">
                    <label for="title" class="block font-semibold mb-2">Members</label>
        
                    <input class="rounded" type="text" name="search" id="search">
                    <div id="searchList" class="absolute bg-white w-56 rounded text-center hidden">
                        <div class="py-1 hover:bg-gray-200 cursor-pointer rounded m-1">Mina Sharon Myoui | Officer</div>
                        <div class="py-1 hover:bg-gray-200 cursor-pointer rounded m-1">Mina Sharon Myoui | Officer</div>
                        <div class="py-1 hover:bg-gray-200 cursor-pointer rounded m-1">Mina Sharon Myoui | Officer</div>
                    </div>
                </div>
                 
                <div class="my-2">
                    <label for="title" class="block font-semibold mb-2">Description</label>
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
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>

                <tbody class="bg-white text-center"></tbody>
            </table>
        </div>
        {{--(TEMPORARY TABLE)--}}
    </div>
</x-app-layout>