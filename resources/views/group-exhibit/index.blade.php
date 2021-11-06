<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    @livewire('group-exhibit', ['group' => $group])
</x-app-layout>