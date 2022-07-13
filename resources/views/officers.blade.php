<x-app-layout title="Officers">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    Officers page (list of officers)
    {{ $election->name }}
</x-app-layout>
