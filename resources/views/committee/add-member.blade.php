<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
   @livewire('add-member', ['committee' => $committee])
</x-app-layout>