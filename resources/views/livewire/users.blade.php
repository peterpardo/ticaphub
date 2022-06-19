<div>
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
                        <x-table.delete-btn />
                        <x-table.delete-btn />
                        <x-table.delete-btn />
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
</div>
