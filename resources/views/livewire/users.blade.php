<div x-data="{
    showAddModal: @entangle('showAddModal').defer,
    showDeleteModal: false,
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Add user --}}
    <x-app.button color='green' @click.prevent="showAddModal = !showAddModal">Add User</x-app.button>


    {{-- User table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Name</x-table.thead>
            <x-table.thead>Email</x-table.thead>
            <x-table.thead>Status</x-table.thead>
            <x-table.thead>Role</x-table.thead>
            <x-table.thead>Action</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($users as $user)
                <tr>
                    <x-table.tdata>{{ $user->fullname }}</x-table.tdata>
                    <x-table.tdata>{{ $user->email }}</x-table.tdata>
                    <x-table.tdata>{{ $user->email_verified }}</x-table.tdata>
                    <x-table.tdata class="space-x-2">
                        @foreach($user->getRoleNames() as $role)
                            <span class="inline-block @if (!$loop->first) pl-3 @endif">
                                {{ $role }}
                            </span>
                        @endforeach
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn @click.prevent="showDeleteModal = !showDeleteModal" wire:click="selectItem({{ $user->id }})"   />
                        <x-table.edit-btn  @click.prevent="showAddModal = !showAddModal" wire:click="$emitTo('users.add-user-form', 'getUser', {{ $user->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No users are found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $users->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add user --}}
    <div x-cloak x-show="showAddModal">
        @livewire('users.add-user-form')
    </div>

    {{-- Delete user --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal.delete-modal>
            <x-modal.title>Delete User</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the user.</x-modal.description>
        </x-modal.delete-modal>
    </div>

</div>
