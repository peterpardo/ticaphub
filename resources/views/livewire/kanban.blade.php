<div class="overflow-hidden">
   {{-- START --}}
   <div class="rounded flex flex-col w-screen h-screen overflow-hidden text-gray-700">
        <div class="flex flex-col px-10 mt-6">
            {{-- <div class="flex flex-col"> --}}
                <h1 class="text-2xl font-bold mr-4 text-gray-800 dark:text-white mb-2">{{ $event->name }}</h1>
                @can('add list')
                <div class="flex items-center">
                    <button wire:click.prevent="openModal('add', {{ $event->id }})" class="bg-white border rounded-md shadow hover:bg-gray-100 px-2 p-1">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="ml-1">Add List</span>
                        </div>
                    </button>
                    <div class="ml-2">
                        <a href="/events/{{ $event->id }}/program-flow" class="inline-block bg-white border rounded-md shadow hover:bg-gray-100 px-2 p-1">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <span class="ml-1">Post Program Flow</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endcan
            {{-- </div> --}}
        </div>
        <div class="flex flex-grow px-10 mt-4 space-x-6 overflow-hidden">
            @foreach($event->lists as $list)
                <div class="flex flex-col flex-shrink-0 w-72 bg-gray-50 rounded">
                    <div class="flex items-center justify-between flex-shrink-0 h-10 px-2">
                        <div class="flex items-center">
                            <span class="block text-sm font-semibold">{{ $list->title }}</span>
                            <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30">{{ $list->tasks->count() }}</span>
                        </div>
                        <div class="flex items-center">
                            @can('add task')
                            <div class="flex items-centerw-6 h-6 ml-auto text-indigo-500 rounded hover:bg-indigo-500 hover:text-indigo-100 mr-2">
                                <a href="/events/{{ $event->id }}/list/{{ $list->id }}/add-task" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </a>
                            </div>
                            @endcan
                            @can('edit list')
                            <div class="flex items-centerw-6 h-6 ml-auto text-blue-500 rounded hover:bg-blue-500 hover:text-indigo-100 mr-2">
                                <button wire:click="openModal('update', {{ $list->id }})" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                            @endcan
                            @can('delete list')
                            <div class="flex items-center w-6 h-6 ml-auto text-red-500 rounded hover:bg-red-500 hover:text-indigo-100">
                                <button wire:click="openModal('delete', {{ $list->id }})" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                            @endcan
                        </div>
                    </div>
                    <div class="flex flex-col pb-2 overflow-hidden shadow-lg rounded-lg"> 
                        @if($list->tasks->count() > 0)
                            @foreach($list->tasks as $task)
                                <div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90">
                                    <div class="absolute flex top-0 right-0 items-center justify-center w-5 h-5 mt-3 mr-1">
                                        <a href="/events/{{ $event->id }}/list/{{ $list->id }}/task/{{ $task->id }}" class="inline-block text-blue-500 rounded hover:bg-gray-200 hover:text-blue-700 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @if(Auth::user()->id == $task->taskCreator->id) 
                                            <button wire:click="openModal('delete', {{ $task->id }}, 'task')" class=" text-red-500 rounded hover:bg-gray-200 hover:text-red-700m mr-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                    <span class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-green-100 rounded-full">{{ $task->taskCreator->first_name }} {{ $task->taskCreator->last_name }}</span>
                                    <h4 class="mt-3 text-sm font-medium">{{ $task->title }}</h4>
                                    <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-1 leading-none">{{ $task->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if($task->taskCreator->profile_picture)
                                            <img class="w-6 h-6 ml-auto rounded-full" src='{{ Storage::URL($task->taskCreator->profile_picture) }}'/>
                                        @else
                                            <img class="w-6 h-6 ml-auto rounded-full" src='{{  url(asset('assets/default-img.png')) }}'/>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-white rounded px-2 py-1 text-center">
                                <span class="inline-block">No tasks</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="flex-shrink-0 w-6"></div>
        </div>

        {{-- DELETE ITEM MODAL --}}
        <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deleteListModal">
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
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete the {{ $item }}? The process cannot be undone.</p>
                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <form>
                            @csrf
                            <button wire:click.prevent="closeDeleteModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                            <button wire:click.prevent="deleteItem" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE ITEM MODAL --}}

        {{-- ADD LIST MODAL --}}
        <div class="min-w-screen hidden h-screen animated fadeIn faster fixed left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="listFormModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    @livewire('list-form', ['event' => $event])
                </div>
            </div>
        </div>
        {{-- ADD LIST MODAL --}}
    </div>
    {{-- STOP --}}
</div>
