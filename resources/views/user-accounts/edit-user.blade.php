<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    @livewire('edit-user', ['user' => $user])
</x-app-layout>
