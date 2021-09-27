<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="font-bold text-3xl text-center mb-3">Manage Election</h1>
    @livewire('add-candidates')
</x-app-layout>