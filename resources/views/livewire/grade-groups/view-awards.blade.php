<div class="space-y-2">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="self-end md:self-auto">
            <div class="border rounded px-2 py-1">
                <input type="checkbox" wire:model="isDone" class="rounded-full text-green-500 mr-2"/>
                <span>Mark as Done</span>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('status'))
       <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        <br/>
        - The first table shows the status of the all the panelists for this specialization, whether they are done grading or not. <br/>
        - The second table shows all of the awards for this specialization. <br/>
        - After evaluating all of the groups for each award, click the <strong>Mark as Done</strong> checkbox at the upper right corner to notify the admin and other panelists that you are done grading. <br/>
        - After the system computes the grades, you will be prompted to pick the best presenter for this specialization.
    </x-info-box>

    <h1 class="font-bold text-xl">Panelists</h1>

    {{-- Panelist Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Panelist name</x-table.thead>
                <x-table.thead>Status</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($panelists as $panelist)
                <tr>
                    @if ($panelist->user->id === auth()->user()->id)
                        <x-table.tdata>
                            <strong>You</strong>
                        </x-table.tdata>
                    @else
                        <x-table.tdata>
                            {{ $panelist->user->fullname }}
                        </x-table.tdata>
                    @endif
                    <x-table.tdata>
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-{{ $panelist->status_color }}-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-{{ $panelist->status_color }}-200 opacity-50 rounded-full"></span>
                            <span class="relative">
                                @if ($panelist->is_done)
                                    done
                                @else
                                    not done
                                @endif
                            </span>
                        </span>
                    </x-table.tdata>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>

    <h1 class="font-bold text-xl">Awards</h1>

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
