<x-app-layout title="Group Exhibit">
    @livewire('group-exhibit.group', [
        'groupExhibit' => $groupExhibit,
        'members' => $members,
        'adviser' => $adviser
    ])
</x-app-layout>
