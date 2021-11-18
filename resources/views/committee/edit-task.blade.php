<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="text-center text-2xl font-semibold my-3">Edit Task</h1>
    <form
        action="/committee/{{ $committee->id }}/task/{{ $task->id }}/edit-task"
        method="POST"
        id="updateTaskForm">
        @csrf
        <input type="hidden" name="committee" id="committee" value="{{ $committee->id }}">
        <input type="hidden" name="task" id="task" value="{{ $task->id }}">
        <div class="w-1/3 mx-auto shadow rounded px-3 py-3 bg-white text-gray-800 ">
            <div class="my-3">
                {{-- MESSAGE STATUS --}}
                <div id="message"></div>
                <label class="block">Task Title</label>
                <input type="text" name="title" id="title" class="rounded w-full" value="{{ $task->title }}">
            </div>
            <div class="my-3">
                <label class="block">Task Description</label>
                <textarea type="text" name="description" id="description" class="rounded w-full resize-none">{{ $task->description }}</textarea>
            </div>
            <div class="my-3">
                <label class="block">Status</label>
                <select name="status" id="status" class="rounded w-full resize-none" value="{{ $task->status }}">
                    <option value="ongoing">ongoing</option>
                    <option value="completed">completed</option>
                </select>
            </div>
            <div class="my-3 relative">
                <label for="title" class="block font-semibold mb-2">Members</label>
                <input type="hidden" id="members" name="members[]" value="">
                <div class="relative">
                  <div id="memberError" class="text-red-500"></div>
                  <input type="text" name="member" id="member" autocomplete="off" class="rounded w-full" placeholder="Search officer">
                  <div id="searchList" class="absolute bg-white rounded z-40 max-h-40 overflow-auto"></div>
                  <div id="memberList"></div>
                </div>
                {{-- TAG CONTAINER --}}
                <div class="relative w-56">
                    <div id="tagContainer"></div>
                </div>
            </div>
            <div class="text-center my-3">
                <a href="/committee/{{ $committee->id }}" class="rounded px-2 py-1 shadow hover:bg-gray-200 inline-block mx-1">Cancel</a>
                <button type="submit" class="bg-green-500 hover:bg-green-500 rounded text-white px-2 py-1 mx-1">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>
