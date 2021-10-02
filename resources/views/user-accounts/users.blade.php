<x-app-layout :scripts="$scripts">
    {{-- <x-page-title>{{ $title }}</x-page-title> --}}
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    @livewire('user-table')
</x-app-layout>
