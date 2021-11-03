<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <div class="text-center">
        <h1 class="font-bold text-4xl mb-3">{{ $ticap }}</h1>
        <h1 class="font-semibold text-3xl">Election Panel</h1>
    </div>
    @livewire('election-panel')
</x-app-layout>