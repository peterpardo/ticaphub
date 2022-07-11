<x-app-layout title="Officers">
    <h1 class="font-bold text-xl mb-2">{{ $election->name }}</h1>
    @if ($election->status === 'not started')
        <div class="flex justify-center items-center bg-gray-100 rounded text-gray-500 p-10">Voting has not yet started</div>
    @else
        @livewire('officers.vote', ['election' => $election])
    @endif
</x-app-layout>
