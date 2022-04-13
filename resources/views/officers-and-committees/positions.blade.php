<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <div class="text-center">
        <h1 class="font-bold text-3xl mb-3">Manage Election</h1>
        <h1 class="font-semibold text-xl">{{ $ticap }}</h1>
    </div>
    @livewire('position-table')
    </div>
</x-app-layout>
