<div x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Navigation --}}
    @include('users.navlinks')

     {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Add group --}}
    <x-app.button color='green' class="mb-2" wire:click.prevent="$emitTo('users.group-form', 'showForm')">
        <i class="fa-solid fa-user-group mr-1"></i>
        Add Group
    </x-app.button>

    {{-- Groups table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Name</x-table.thead>
            <x-table.thead>School/Specialization</x-table.thead>
            <x-table.thead>Adviser</x-table.thead>
            <x-table.thead>Member Count</x-table.thead>
            <x-table.thead>Action</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($groups as $group)
                <tr>
                    <x-table.tdata>{{ $group->name }}</x-table.tdata>
                    <x-table.tdata>{{ $group->specialization->school->name }} - {{ $group->specialization->name }}</x-table.tdata>
                    <x-table.tdata>
                        @if (!is_null($group->adviser_id))
                            {{ $group->adviser->name }}
                        @else
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden
                                    class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                <span class="relative">none</span>
                            </span>
                        @endif
                    </x-table.tdata>
                    <x-table.tdata>
                        @if ($group->user_specializations_count  > 0)
                           {{ $group->user_specializations_count }}
                        @else
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden
                                    class="absolute inset-0 bg-red-200 opacity-50 rounded-full">
                                </span>
                                <span class="relative">{{ $group->user_specializations_count }}</span>
                            </span>
                        @endif
                    </x-table.tdata>
                    <x-table.tdata-actions>

                        <x-table.delete-btn wire:click="selectItem({{ $group->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('users.group-form', 'getGroup', {{ $group->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No groups found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $groups->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add group --}}
    @livewire('users.group-form')

    {{-- Delete group --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Group</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the group. You will need to manually assign a new group for each member of this deleted group.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete group.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
