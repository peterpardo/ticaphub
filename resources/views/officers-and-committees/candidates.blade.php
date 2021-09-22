<x-app-layout>

    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <h1 class="font-bold text-3xl text-center mb-3">Manage Election</h1>
        @livewire('add-candidates')
    </div>

</x-app-layout>