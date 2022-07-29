<x-app-layout :title="$groupExhibit->group->name">
    @livewire('group-exhibit.group', ['groupExhibit' => $groupExhibit])
</x-app-layout>
