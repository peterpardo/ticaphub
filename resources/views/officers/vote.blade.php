<x-app-layout title="Officers">
    @if ($election->status === 'not started')
        Election not yet started
    @else
        vote for {{ $election->name }}
    @endif
</x-app-layout>
