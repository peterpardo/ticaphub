<div x-data="{
    showImportModal: false,
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Navigation --}}
    @include('users.navlinks')

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        You can manually add users by clicking the <span class="font-bold">Add User</span> button below. You can also add multiple students at once by clicking the <span class="font-bold">Import Students</span> button.
    </x-info-box>

    <div class="flex flex-col-reverse gap-y-2 lg:flex-row lg:justify-between lg:items-center">
        {{-- Search box --}}
        <div class="max-w-96">
            <x-form.input wire:model="search" placeholder="Search name..."/>
        </div>

        <div>
            {{-- Add user --}}
            <x-app.button color='green' wire:click="$emitTo('users.user-form', 'showForm')" class="mb-2 sm:mb-0">
                <i class="fa-solid fa-user-plus mr-1"></i>
                Add User
            </x-app.button>

            {{-- Import students --}}
            <x-app.button type="link" href="{{ route('import-students') }}" color='indigo' >
                <i class="fa-solid fa-file-import mr-1"></i>
                Import Students
            </x-app.button>
        </div>
    </div>


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
                    <x-table.tdata>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                <img
                                    class="w-full object-cover"
                                    @if (is_null($user->profile_picture))
                                        src="{{ url(asset('assets/default-img.png')) }}"
                                    @else
                                        src="{{ url(asset($user->profile_picture)) }}"
                                    @endif
                                    alt="profile_picture" />
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $user->fullname }}
                                </p>
                            </div>
                        </div>
                    </x-table.tdata>
                    <x-table.tdata>{{ $user->email }}</x-table.tdata>
                    <x-table.tdata>
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-{{ $user->status }}-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-{{ $user->status }}-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{ $user->email_verified }}</span>
                        </span>
                    </x-table.tdata>
                    <x-table.tdata class="space-x-2">
                        @foreach($user->getRoleNames() as $role)
                            <span class="inline-block @if (!$loop->first) pl-3 @endif">
                                {{ $role }}
                            </span>
                        @endforeach
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        {{-- Don't allow edit and delete the superadmin --}}
                        @if(!$user->hasRole('superadmin'))
                            {{-- Don't allow admin to delete/edit admin accounts --}}
                            @if (auth()->user()->hasRole('superadmin') || (auth()->user()->hasRole('admin') && !$user->hasRole('admin')))
                                <x-table.delete-btn wire:click="selectItem({{ $user->id }})"/>
                                <x-table.edit-btn type="link" href="{{ url('users/' . $user->id) }}"/>
                            {{-- Don't allow students to delete/edit own account --}}
                            @elseif ((auth()->user()->hasRole('student') && !$user->hasRole('admin')) && auth()->user()->email != $user->email)
                                <x-table.delete-btn wire:click="selectItem({{ $user->id }})"/>
                                <x-table.edit-btn type="link" href="{{ url('users/' . $user->id) }}"/>
                            @endif
                        @endif
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No users found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $users->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add user --}}
    @livewire('users.user-form')

    {{-- Delete user --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete User</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the user.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal('delete')">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete user.</x-app.button>
            </div>
        </x-modal>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('refreshFile', () => {
                document.getElementById('file').value = '';
            })
        </script>
    @endpush
</div>
