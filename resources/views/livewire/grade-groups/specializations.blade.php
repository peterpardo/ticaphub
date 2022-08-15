<div>
    {{-- Alert --}}
    @if (session('status'))
       <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
       Below is the table of all the specializations you are assigned to panel. If there is none, contact an event organizer to assign you a specialization.
    </x-info-box>

    {{-- Specializations Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>School</x-table.thead>
                <x-table.thead>Specialization</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($specs as $spec)
                <tr>
                    <x-table.tdata>{{ $spec->specialization->school->name }}</x-table.tdata>
                    <x-table.tdata>{{ $spec->specialization->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.view-btn href="{{ url('grade-groups/' . $spec->specialization->id ) }}"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No specializations are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>
</div>
