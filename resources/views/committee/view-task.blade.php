<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="text-center text-2xl font-semibold my-3">View Task</h1>
    <div class="w-1/3 mx-auto shadow rounded px-3 py-3 bg-white text-gray-800">
        <div class="my-3">
            <label class="block font-semibold mb-2">Task Title</label>
            <div class="border w-full px-2 py-1 rounded">{{ $task->title }}</div>
        </div>
        <div class="my-3">
            <label class="block font-semibold mb-2">Task Description</label>
            <div class="border w-full px-2 py-1 rounded">{{ $task->description }}</div>
        </div>
        <div class="my-3">
            <label class="block font-semibold mb-2">Status</label>
            <div class="border w-full px-2 py-1 rounded">{{ $task->status }}</div>
        </div>
        <div class="my-3">
            <label for="title" class="block font-semibold mb-2">Members</label>
            <ul>
                @foreach($task->users as $user)
                <li>{{ $user->first_name . ' '  . $user->middle_name . ' ' . $user->last_name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="text-center">
            <a href="/committee/{{ $committee->id }}" class="text-white bg-green-400 rounded px-2 py-1 shadow hover:bg-green-200 inline-block mx-1">Back</a>
        </div>
    </div>
</x-app-layout>
