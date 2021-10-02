<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div>
        <h1 class="font-bold text-center text-3xl my-4">Edit User</h1>
        @livewire('edit-user', ['user' => $user])
    </div>
</x-app-layout>