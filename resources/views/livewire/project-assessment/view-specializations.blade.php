<div>
    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can pick a specialization and set the awards</span>
    </x-info-box>

    {{-- Specializations Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>School</x-table.thead>
                <x-table.thead>Specialization</x-table.thead>
                <x-table.thead>Status</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($specializations as $specialization)
                <tr>
                    <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
                    <x-table.tdata>{{ $specialization->name }}</x-table.tdata>
                    <x-table.tdata>
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-{{ $specialization->status_color }}-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-{{ $specialization->status_color }}-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{ $specialization   ->status }}</span>
                        </span>
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.view-btn href="{{ url('officers/set-positions/' . $specialization->id) }}"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No specializations are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $specializations->links() }}
        </x-slot>
    </x-table>
</div>
