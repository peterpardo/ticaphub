<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    @livewire('program-flow', ['event' => $event])
</x-app-layout>