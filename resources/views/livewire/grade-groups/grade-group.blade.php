<div class="space-y-2">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specializationName }} | {{ $awardName }}</h1>

        <div class="self-end md:self-auto">
            <x-app.button color="blue">
                Edit Grades
                <i class="fa-solid fa-pen-to-square"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Note --}}
    <x-info-box color="yellow">
        Here is the list of all the groups and the criteria. Click the <strong>Edit Grades</strong> button to change the grades of each group for each criteria.
     </x-info-box>

      {{-- Awards Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead></x-table.thead>
                @foreach ($criteria as $crit)
                    <x-table.thead>{{ $crit->name }} ({{ $crit->percentage }}%)</x-table.thead>
                @endforeach
                <x-table.thead>
                    <strong>Total</strong>
                </x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($groups as $group)
                <tr>
                    <x-table.tdata>{{ $group->name }}</x-table.tdata>
                    @foreach ($criteria as $crit)
                        @if($group->groupGrades->contains('criteria_id', $crit->id))
                            <x-table.tdata>{{ number_format($group->groupGrades->where('criteria_id', $crit->id)->pluck('grade')->first(), 1) }}</x-table.tdata>
                        @else
                            <x-table.tdata><x-form.input type="number"/></x-table.tdata>
                        @endif
                    @endforeach
                    <x-table.tdata>
                        <strong>0.0</strong>
                    </x-table.tdata>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No groups are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>
</div>
