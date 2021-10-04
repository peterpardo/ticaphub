<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-3xl text-center mb-3">Manage Election</h1>
    @livewire('add-candidates')
</x-app-layout>