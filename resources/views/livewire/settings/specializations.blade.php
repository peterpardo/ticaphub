<div>
    {{-- Navbar --}}
    @include('settings.navbar')

    {{-- Alert --}}
    @if (session('status'))
       <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can update the name of the specializations for this TICaP event.
    </x-info-box>

    {{-- Specialization Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>school</x-table.thead>
                <x-table.thead>specialization</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($specializations as $specialization)
                <tr>
                    <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
                    <x-table.tdata>{{ $specialization->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('settings.specialization-form', 'getSpecialization', {{ $specialization->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No Specializations are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $specializations->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    @livewire('settings.specialization-form')
</div>
