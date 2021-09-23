<x-app-layout>
    <x-page-title>{{ $title }}</x-page-title>
    <div>
        <h1 class="font-bold text-center text-3xl my-4">Edit User</h1>
        @livewire('edit-user', ['userId' => $userId])
    </div>
</x-app-layout>