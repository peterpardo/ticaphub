<div>
    {{-- Elections Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Election Name</x-table.thead>
                <x-table.thead>No. of Voters (Students)</x-table.thead>
                <x-table.thead>Status</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($elections as $election)
                <tr>
                    <x-table.tdata>{{ $election->name }}</x-table.tdata>
                    <x-table.tdata>{{ $election->user_elections_count }}</x-table.tdata>
                    <x-table.tdata>{{ $election->status }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn />
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No elections are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $elections->links() }}
        </x-slot>
    </x-table>
</div>
