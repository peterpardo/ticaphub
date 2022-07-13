<x-app-layout title="Officers">
    <h1 class="font-bold text-xl mb-2">{{ $election->name }}</h1>
    @if ($election->status === 'not started')
        {{-- Alert --}}
        @if (session('status'))
            <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
        @endif

        <div class="flex justify-center items-center bg-gray-100 rounded text-gray-500 p-10">Voting has not yet started</div>
    @elseif ($election->status === 'in progress')
        @livewire('officers.vote', ['election' => $election])
    @else
        <div>Officers for this election</div>
    @endif
</x-app-layout>
