<div>
    {{-- User table --}}
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
                            {{ $groups->adviser->name }}
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
                                <span class="relative">empty</span>
                            </span>
                        @endif
                    </x-table.tdata>
                    <x-table.tdata-actions>

                        <x-table.delete-btn/>
                        <x-table.edit-btn type="button"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No users are found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $groups->links() }}
        </x-slot>
    </x-table>
</div>
