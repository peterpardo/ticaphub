<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <a href="/events/{{ $event->id }}" class="rounded bg-red-500 text-white px-5 py-1">Back</a>
        <h1 class="text-center text-4xl font-bold mb-2">{{ $event->name }}</h1>
        <input type="hidden" name="event" id="event" value="{{ $event->id }}">

        <h1 class="text-center text-3xl font-bold mb-3">{{ $list->title }}</h1>
        <input type="hidden" name="list" id="list" value="{{ $list->id }}">

        <a href="/events/{{ $event->id }}/list/{{ $list->id }}/add-task" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 text-lg mb-3 shadow">Add Task</a>
        
        {{-- MESSAGE STATUS --}}
        @if(session('status'))
            <div class="text-{{ session('status') }}-500">{{ session('message') }}</div>
        @endif
        {{-- ADD TASK--}}
        {{-- @can('add task')
        <div class="container shadow-md p-3 rounded mb-2">
            <h1 class="font-bold text-2xl my-3">Add Task</h1>

            MESSAGE STATUS
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

                    TAG CONTAINER
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
        @endcan --}}
        {{-- ADD TASK --}}

        {{--(TEMPORARY TABLE)--}}
        <div class="container">
            <table class="w-full shadow">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Created by</th>
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Specialization</th>
                        <th class="px-4 py-3">Position</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>   
                </thead>

                <tbody class="bg-white text-center">
                    @if($list->tasks == null)
                    <div class="text-red-500 text-center mb-2">No Task Created Yet</div>
                    @else
                        @foreach($list->tasks as $task)
                        <tr>
                            <td class="px-4 py-3 border">{{ $task->title }}</td>  
                            <td class="px-4 py-3 border">{{ $task->taskCreator->first_name }} {{ $task->taskCreator->middle_name }} {{ $task->taskCreator->last_name }}</td>
                            <td class="px-4 py-3 border">{{ $task->taskCreator->school->name }}</td>
                            <td class="px-4 py-3 border">
                                @if($task->taskCreator->hasRole('admin'))
                                    Faculty
                                @else
                                {{ $task->taskCreator->userSpecialization->specialization->name }}
                                @endif
                            </td>
                            <td class="px-4 py-3 border">
                                @if($task->taskCreator->hasRole('admin'))
                                    Faculty
                                @else
                                {{ $task->taskCreator->officer->position->name }}
                                @endif
                            </td>
                            <td class="px-4 py-3 border">{{ $task->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-3 border">
                                <a href="/events/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}" class="inline-block bg-blue-500 px-4 py-1 m-0.5 rounded text-white hover:bg-blue-600">View</a>
                                {{-- TASK CAN ONLY BE DELETED BY ITS CREATOR AND ADMIN --}}
                                @if(Auth::user()->id == $task->taskCreator->id || Auth::user()->hasRole('admin'))
                                @can('delete task')
                                <button id="modalBtn" data-id="{{ $task->id }}" class="deleteTaskBtn bg-red-500 px-4 py-1 m-0.5 rounded text-white hover:bg-red-600">Delete</button>
                                @endcan
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{--(TEMPORARY TABLE)--}}
    </div>

    {{-- DELETE TASK MODAL --}}
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

                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the task? The process cannot be undone</p>

                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">

                    <form 
                        action="/events/{{ $event->id }}/list/{{ $list->id }}/delete-task"
                        method="POST"
                        id="deleteTaskForm">
                        @csrf

                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        
                        <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>

                    </form>

                </div>

            </div>

        </div>

    </div>
    {{-- DELETE TASK MODAL --}}


</x-app-layout>