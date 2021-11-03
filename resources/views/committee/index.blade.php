<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="text-xl my-3"><span class="font-semibold">Committee Head:</span> {{ $committee->user->first_name . ' ' . $committee->user->middle_name . ' ' . $committee->user->last_name}}</h1>
    <div class="mb-3">
        @can('assign task to student')
            <a href="/committee/{{ $committee->id }}/add-task" class="inline-block bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">Add Task</a>
            <a href="/committee/{{ $committee->id }}/add-member" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Add Members</a>
        @endcan
    </div>
    @if($committee->tasks->count() == 0)
        <div class="bg-gray-200 rounded py-5 block text-center">No Tasks Created</div>
    @else
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
            <table class="w-full table-fixed">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Task</th>
                    <th class="px-4 py-3">Updated At</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
                </thead>
            <tbody class="bg-white">
                @foreach ($committee->tasks()->orderBy('updated_at', 'desc')->get() as $task)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-md font-semibold border">{{ $task->title }}</td>
                        <td class="px-4 py-3 text-md font-semibold border">{{ $task->updated_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 text-md font-semibold border">{{ $task->status }}</td>
                        <td class="px-4 py-3 text-md border text-center">
                            <a href="/committee/{{ $committee->id }}/task/{{ $task->id }}/view-task" class="inline-block rounded shadow px-2 py-1 text-white bg-green-500 hover:bg-green-600">view</a>
                            @can('assign task to student')
                                <a href="/committee/{{ $committee->id }}/task/{{ $task->id }}/edit-task"  class="inline-block rounded shadow px-2 py-1 text-white bg-blue-500 hover:bg-blue-600">edit</a>
                                <button data-id="{{ $task->id }}" class="deleteTaskBtn rounded shadow px-2 py-1 text-white bg-red-500 hover:bg-red-600">delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endif

    {{-- DELETE TASK MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deleteModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div >
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
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <form 
                        action="/committee/{{ $committee->id }}/delete-task"
                        method="POST"
                        id="deleteTaskForm">
                        @csrf
                        <a href="javascript:;" class="closeDeleteModal inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE TASK MODAL --}}
</x-app-layout>