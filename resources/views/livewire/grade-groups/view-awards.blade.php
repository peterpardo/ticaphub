<div class="space-y-2">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="self-end md:self-auto">
            <x-app.button color="green">
                Submit Evaluations
                <i class="fa-solid fa-check"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Note --}}
    <x-info-box color="yellow">
       Here, you can pick an award you want to evaluate.
    </x-info-box>

    {{-- Awards Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Award name</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($awards as $award)
                <tr>
                    <x-table.tdata>{{ $award->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.view-btn href="{{ url('grade-groups/award/' . $award->id ) }}"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No awards are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>
</div>
