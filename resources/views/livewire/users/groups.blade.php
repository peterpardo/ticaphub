<div x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Navigation --}}
    @include('users.navlinks')

     {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        You can add groups here by clicking the <span class="font-bold">Add Group</span> button below. Keep in mind that each group must have <strong>an adviser</strong> and <span class="font-bold">atleast have one(1) member</span> to be able to create awards for the TICaP.
    </x-info-box>

    <div class="flex flex-col-reverse gap-y-2 lg:flex-row lg:justify-between lg:items-center">
        {{-- Search box --}}
        <div class="max-w-96">
            <x-form.input wire:model="search" placeholder="Search group..."/>
        </div>

        {{-- Add group --}}
        <x-app.button color='green' wire:click.prevent="$emitTo('users.group-form', 'showForm')">
            <i class="fa-solid fa-user-plus mr-1"></i>
            Add Group
        </x-app.button>
    </div>


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
