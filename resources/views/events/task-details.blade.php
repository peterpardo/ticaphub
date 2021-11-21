<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div>
        <a href="/events/{{ $event->id }}" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-5xl font-bold mb-4">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">
        <h1 class="text-center text-4xl font-semibold">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">
        <input type="hidden" name="task" id="task" value="{{ $task->id }}">
        {{-- MAIN DIV --}}
        <div class="flex flex-col xl:flex-row w-full my-5 shadow rounded-lg bg-white p-2 text-gray-800">
            {{-- LEFT SIDE --}}
            <div class="flex flex-col my-1 xl:flex-1 xl:mx-2">
                <div class="flex my-2">
                    <div class="flex-1">
                        <h1 class="font-semibold text-3xl">Title</h1>
                        <div class="text-xl w-1/2 px-2 py-1 rounded">{{ $task->title }}</div>  
                    </div>
                    {{-- SHOW UPDATE TASK TO TASK CREATOR ONLY --}}
                    @if(Auth::user()->id == $task->taskCreator->id)
                    <div>
                        <a href="{{ url()->current() }}/update-task" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded" id="modal-btn">Update Task</a>
                    </div>
                    @endif
                </div>
                <div class="my-2">
                    <h1 class="font-semibold text-3xl">Description</h1>
                    <div class="text-xl w-1/2 px-2 py-1 rounded">{{ $task->description }}</div>  
                </div>
                <div class="my-2">
                    <div class="flex">
                        <h1 class="font-semibold text-3xl">Members</h1>
                    </div>
                    <ul class="text-md list-disc list-inside">
                        @foreach ($task->users as $user)
                            <li>{{ $user->first_name . ' ' . $user->middle_name . ' ' .  $user->last_name . ' | ' . $user->userSpecialization->specialization->name }}</li>
                        @endforeach
                    </ul>  
                </div>
                <div class="my-2">
                    <h1 class="font-semibold text-3xl">Files</h1>
                    <div id="fileContainer" class="text-md"></div>  
                </div>    
            </div>
            {{-- LEFT SIDE --}}
            {{-- RIGHT SIDE --}}
            <div class="flex flex-col xl:flex-1 xl:mx-2">
                <div class="my-2">
                    {{-- ONLY OFFICERS INCLUDED IN THE TASK CAN ADD REPORT --}}
                    @if($task->users()->where('id', Auth::user()->id)->exists() || Auth::user()->id == $task->taskCreator->id)
                    @can('add report')
                    <div class="w-full rounded p-2 border border-black">
                        <form 
                            action="/events/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}" 
                            method="POST" 
                            enctype="multipart/form-data"
                            id="addActivityForm">
                            @csrf
                            <h1 class="text-xl font-semibold">Add Report</h1>
                            <span id="activityError" class="text-red-500"></span>
                            <textarea name="description" id="description" class="w-full h-36 resize-none rounded border-gray-300"></textarea>
                            <div class="flex justify-between">
                                <input type="file" name="files[]" multiple>
                                <button type="submit" class="rounded bg-green-500 hover:bg-green-600 cursor-pointer px-2 py-1 text-white">Add Activity</button>
                            </div>
                        </form>
                    </div>  
                    @endcan
                    @endif
                    <h1 class="font-semibold text-3xl mt-3">Activity Reports</h1>
                    <div id="activityList" class="w-full rounded p-2 border border-black"></div>  
                </div>
            </div>
            {{-- RIGHT SIDE --}}
        </div>
        {{-- MAIN DIV --}}

    </div>
</x-app-layout>