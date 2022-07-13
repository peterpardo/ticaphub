<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can see all of the elections automatically created by TICAPHUB based on the specializations created in each school. <span class="italic">(Only one election will be created for FEU Diliman and FEU Alabang if they are involved in the current TICaP)</span>
    </x-info-box>

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
                    <x-table.tdata>
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-{{ $election->status_color }}-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-{{ $election->status_color }}-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{ $election->status }}</span>
                        </span>
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.view-btn href="{{ url('officers/set-positions/' . $election->id) }}"/>
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
