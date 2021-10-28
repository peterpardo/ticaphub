<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex items-center justify-between">
        <a href="/schedules/create" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-2">Create Schedule/Event</a>
        <a href="/schedules/calendar" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mb-2">View Calendar</a>
    </div>

    @if(session('status'))
        <div class="bg-{{ session('status') }}-500 rounded px-2 py-5 text-center text-white">{{ session('message') }}</div>
    @endif

    @livewire('schedule')

</x-app-layout>