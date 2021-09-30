<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    @livewire('group-exhibit', ['group' => $group])
    {{-- <div class="flex w-full">
        <div class="flex-1 shadow-lg mr-2 px-4 py-2">
            <a href="/group-exhibit/{{ $group->id }}/update" class="inline-block bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-4">Update Exihibit</a>
            @if(session('status'))
            <span class="bg-{{ session('status') }}-500 text-white px-2 py-1 rounded block">{{ session('message') }}</span>
            @endif
            <div class="mb-2">
                <h1 class="font-bold text-lg">Project Title</h1>
                <div class="border rounded px-2 py-2">{{ $group->groupExhibit->title }}</div>
            </div>
            <div class="mb-2">
                <h1 class="font-bold text-lg">Project Description</h1>
                <div class="border rounded px-2 py-2">{{ $group->groupExhibit->description }}</div>
            </div>
            <div class="mb-2">
                <h1 class="font-bold text-lg">Banner</h1>
                <img src="{{ Storage::url($group->groupExhibit->banner_path) }}" alt="banner">
            </div>
            <div class="mb-2">
                <h1 class="font-bold text-lg">Video</h1>
                
            </div>
        </div>
        <div class="flex-1 ml-2">
            <div class="shadow-lg px-4 py-2 rounded-lg mb-4">
                <div class="mb-2">
                    <h1 class="font-bold text-lg">Group Details</h1>
                    <ul>
                        <li class="my-1">{{ $group->specialization->school->name }}</li>
                        <li class="my-1">{{ $group->specialization->name }}</li>
                    </ul>
                </div>
                <div class="mb-2">
                    <h1 class="font-bold text-lg">Members</h1>
                    <ul>
                        @foreach($group->userGroups as $userGroup)
                        <li class="my-1">{{ $userGroup->user->first_name . ' ' . $userGroup->user->middle_name . ' ' . $userGroup->user->last_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>