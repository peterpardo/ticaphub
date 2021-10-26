<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-center text-3xl my-4">Update Profile</h1>
    @livewire('user-profile', ['user' => $user]);
</x-app-layout>