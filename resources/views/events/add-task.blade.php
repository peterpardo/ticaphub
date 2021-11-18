<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div>
        <a href="/events/{{ $event->id }}" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-5xl font-bold mb-4">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">
        <h1 class="text-center text-4xl font-semibold">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">
        <div class="container p-3 rounded mb-2 w-4/5 shadow-md mx-auto bg-white text-gray-800">
            <h1 class="font-bold text-2xl my-3 text-center">Add Task</h1>
            <form id="addTaskForm">
            @csrf
                <div class="flex flex-col xl:flex-row">
                    {{-- LEFT SIDE --}}
                    <div class="flex-1">
                        {{-- MESSAGE STATUS --}}
                        <div id="message"></div>
                        <div class="my-2">
                            <label for="title" class="block font-semibold mb-2">Title</label>
                            <input class="text-gray-800 rounded w-full xl:w-3/4" type="text" name="title" id="title" autocomplete="off">
                        </div>
                        {{-- <div class="my-2 relative">
                            <label for="title" class="block font-semibold">Officers</label>
                            
                            <div class="relative mb-2">
                                <div id="memberError" class="text-red-500"></div>
                                <input type="text" name="member" id="member" autocomplete="off" class="rounded w-full xl:w-3/4" placeholder="Search officer">

                                <div id="searchList" class="absolute bg-white rounded z-40 max-h-40 overflow-auto"></div>
                                
                                <div id="memberList"></div>
                            </div>
                        </div> --}}
                        <div class="my-2 relative">
                            <label for="title" class="block font-semibold mb-2">Member</label>
                            <input type="hidden" id="members" name="members[]" value="">
                            <div class="relative">
                              <div id="memberError" class="text-red-500"></div>
                              <input type="text" name="member" id="member" autocomplete="off" class="text-gray-800 rounded w-full xl:w-3/4" placeholder="Search officer">
                              <div id="searchList" class="absolute bg-white rounded z-40 max-h-40 overflow-auto"></div>
                            </div>
                            {{-- TAG CONTAINER --}}
                            <div class="relative w-56">                
                                <div id="tagContainer"></div>
                            </div>
                        </div>
                    </div>
                    {{-- LEFT SIDE --}}
                    {{-- RIGHT SIDE --}}
                    <div class="flex-1">
                        <label for="description" class="block font-semibold mb-2">Description</label>
                        <textarea id="description" class="text-gray-800 resize-none w-full h-40 rounded"></textarea>
                    </div>
                    {{-- RIGHT SIDE --}}
                </div>
                <div class="text-center my-3">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>