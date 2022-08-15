<x-app-layout title="Project Assessment - Panelists">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    panelists
</x-app-layout>
