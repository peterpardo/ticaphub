<x-app-layout :scripts="$scripts">
    <x-page-title>{{ $title }}</x-page-title>
    <div>
        @livewire('award-table')
    </div>
</x-app-layout>