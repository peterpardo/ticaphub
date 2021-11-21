<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div >
        <a href="/events/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-5xl font-bold mb-4">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">
        <h1 class="text-center text-4xl font-semibold">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">
        <input type="hidden" name="task" id="task" value="{{ $task->id }}">
        <div class="bg-white container p-3 rounded mb-2 w-4/5 shadow-md mx-auto">
            <h1 class="font-bold text-2xl my-3 text-center text-gray-800">Update Task</h1>
            <form id="updateTaskForm">
            @csrf
                <div class="bg-white text-gray-800 flex flex-col xl:flex-row">
                    {{-- LEFT SIDE --}}
                    <div class="flex-1">
                        {{-- MESSAGE STATUS --}}
                        <div id="message"></div>
                        <div class="my-2">
                            <label for="title" class="block font-semibold mb-2">Title</label>
                            <input class="rounded w-full xl:w-3/4" type="text" name="title" id="title" autocomplete="off" value="{{ $task->title }}">
                        </div>
                        <div class="my-2 relative">
                            <label for="title" class="block font-semibold">Officers</label>
                            <div class="relative mb-2">
                                <div id="memberError" class="text-red-500"></div>
                                <input type="text" name="member" id="member" autocomplete="off" class="rounded w-full xl:w-3/4" placeholder="Search officer">
                                <div id="searchList" class="absolute bg-white rounded z-40 max-h-40 overflow-auto"></div>
                                <div id="memberList"></div>
                            </div>
                        </div>
                    </div>
                    {{-- LEFT SIDE --}}
                    {{-- RIGHT SIDE --}}
                    <div class="flex-1">
                        <label for="description" class="block font-semibold mb-2">Description</label>
                        <textarea id="description" class="resize-none w-full h-40 rounded">{{ $task->description }}</textarea>
                    </div>
                    {{-- RIGHT SIDE --}}
                </div>
                <div class="text-center my-3">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update Task</button>
                    <button id="modal-btn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Move To</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MOVE TASK TO MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div >
                <form 
                    action="/event/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}/move-task" 
                    method="POST"
                    id="moveTaskForm">
                    @csrf
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <label for="list" class="font-semibold text-lg block">Move Task to</label>
                    <div id="moveTaskError"></div>
                    <select name="list" class="rounded">
                        <option value="">--select a list--</option>
                        @foreach($lists as $l)
                            @if($l->id != $list->id)
                            <option value="{{ $l->id }}">{{ $l->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Move</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MOVE TASK TO MODAL --}}
</x-app-layout>