<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <h1 class="text-center text-5xl font-bold mb-4">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">

        <h1 class="text-center text-4xl font-semibold">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">
        
        <input type="hidden" name="task" id="task" value="{{ $task->id }}">
        
        {{-- MAIN DIV --}}
        <div class="flex flex-col xl:flex-row w-full my-5 shadow rounded-lg bg-white p-2">
            {{-- LEFT SIDE --}}
            <div class="flex flex-col my-1 xl:flex-1 xl:mx-2">
                <div class="flex my-2">
                    <div class="flex-1">
                        
                        {{-- <div id="moveTaskError" class="text-red-500"></div> --}}

                        <h1 class="font-semibold text-3xl">Title</h1>
                        <div class="text-xl w-1/2 px-2 py-1 rounded">
                            {{ $task->title }}
                        </div>  
                    </div>
                    <div>
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded" id="modal-btn">Move Task To</button>
                    </div>
                    
                </div>
                <div class="my-2">
                    <h1 class="font-semibold text-3xl">Description</h1>
                    <div class="text-xl w-1/2 px-2 py-1 rounded">
                        {{ $task->description }}
                    </div>  
                </div>
                <div class="my-2">
                    <div class="w-full rounded p-2 border border-black">
                        <form 
                            id="addActivityForm" 
                            action="/events/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}" 
                            method="POST" 
                            enctype="multipart/form-data">
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

                    <h1 class="font-semibold text-3xl mt-3">Activity Reports</h1>
                    <div id="activityList" class="w-full rounded p-2 border border-black"></div>  
                </div>
            </div>
            {{-- LEFT SIDE --}}

            {{-- RIGHT SIDE --}}
            <div class="flex flex-col xl:flex-1 xl:mx-2">
                <div class="my-2">
                    <div class="flex">
                        <h1 class="font-semibold text-3xl">Members</h1>
                        <button class="ml-2 rounded bg-blue-500 hover:bg-blue-600 text-white px-2">+ Member</button>
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
            {{-- RIGHT SIDE --}}
        </div>
        {{-- MAIN DIV --}}

    </div>

    {{-- MOVE TASK TO MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
    
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <form 
                    action="/event/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}/move-task" 
                    method="POST"
                    id="moveTaskForm">
                    @csrf
               
                <div class="text-center p-5 flex-auto justify-center">

                    <label for="list" class="font-semibold text-lg block">Move Task to</label>
                    <select name="list" class="rounded">
                        <option value="">--select a list--</option>
                        @foreach($lists as $l)
                            @if($l->id != $list->id)
                            <option value="{{ $l->id }}">{{ $l->title }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                <!--footer-->
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