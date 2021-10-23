<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <a href="/schedules/create" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-2">Create Schedule/Event</a>

    @if(session('status'))
        <div class="bg-{{ session('status') }}-500 rounded px-2 py-5 text-center text-white">{{ session('message') }}</div>
    @endif
    
    @livewire('schedule')

</x-app-layout>