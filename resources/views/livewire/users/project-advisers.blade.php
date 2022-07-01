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
        You can add advisers here by clicking the <span class="font-bold">Add Adviser</span> button below.
    </x-info-box>

    <div class="flex flex-col-reverse gap-y-2 lg:flex-row lg:justify-between lg:items-center">
        {{-- Search box --}}
        <div class="max-w-96">
            <x-form.input wire:model="search" placeholder="Search group..."/>
        </div>

        {{-- Add adviser --}}
        <x-app.button color='green' wire:click.prevent="$emitTo('users.project-adviser-form', 'showForm')">
            <i class="fa-solid fa-user-plus mr-1"></i>
            Add Adviser
        </x-app.button>
    </div>

     {{-- Advisers table --}}
     <x-table>
        <x-slot name="heading">
            <x-table.thead>Name</x-table.thead>
            <x-table.thead>Action</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($advisers as $adviser)
                <tr>
                    <x-table.tdata>{{ $adviser->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="selectItem({{ $adviser->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('users.project-adviser-form', 'getAdviser', {{ $adviser->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No advisers found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $advisers->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add adviser --}}
    @livewire('users.project-adviser-form')

     {{-- Delete adviser --}}
     <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Adviser</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the adviser. You will need to manually assign a new adviser to the groups of this deleted adviser.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete adviser.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
