<x-app-layout :scripts="$scripts">
    {{-- <x-page-title>{{ $title }}</x-page-title> --}}
    <div class="font-extrabold text-4xl my-2">Add Users</div>
    @livewire('user-table')
</x-app-layout>
