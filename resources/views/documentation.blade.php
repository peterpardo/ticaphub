<x-app-layout title="Documentation" showSidebar="{{ $showSidebar }}">
    {{-- Ticap table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>TICaP Name</x-table.thead>
            <x-table.thead>Action</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($ticaps as $ticap)
                <tr>
                    <x-table.tdata>{{ $ticap->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        @if ($ticap->is_done)
                            <x-table.delete-btn />
                            <x-table.edit-btn type="link"/>
                        @else
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                                <span aria-hidden
                                    class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                                <span class="relative">Ongoing</span>
                            </span>
                        @endif
                    </x-table.tdata-actions>
                </tr>
            @empty
                <x-table.tdata>No ticaps found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $ticaps->links() }}
        </x-slot>
    </x-table>
</x-app-layout>
