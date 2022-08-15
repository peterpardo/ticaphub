<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can pick a specialization and set the awards. Make sure to create a rubric first, click the <strong>View Rubrics</strong> button, which will be used for the award
    </x-info-box>

    <div class="text-right">
        <x-app.button color="blue" type="link" href="{{ url('/project-assessment/rubrics') }}">
            <i class="fa-solid fa-eye mr-1"></i>
            View Rubrics
        </x-app.button>
    </div>

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
                            <span class="relative">{{ $specialization->status }}</span>
                        </span>
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.view-btn href="{{ url('project-assessment/' . $specialization->id ) }}"/>
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

    {{-- Modals --}}
    @livewire('project-assessment.rubric-form')
</div>
