<div class="space-y-2">
    {{-- Election name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $election->name }}</h1>

        <div class="flex gap-x-1 self-end md:self-auto">
            <x-app.button type="link" href="{{ url('officers/set-positions/' . $election->id) }}" color="gray">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Set Positions
            </x-app.button>
            <x-app.button type="link" href="{{ url('officers/set-candidates/' . $election->id) }}" color="indigo">
                Review Election
                <i class="fa-solid fa-arrow-right ml-1"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        After creating the positions for the election, add candidates/nominees for this election. Please take note that each position must <strong>atleast have two or more candidates</strong> for the election to start.
    </x-info-box>

    {{-- Add Candidate Button --}}
    <div class="space-y-1">
        <h2 class="text-lg font-semibold">Set Candidate</h2>
        <x-app.button color="green" wire:click.prevent="$emitTo('officers.candidate-form', 'showModal')">
            <i class="fa-solid fa-plus mr-1"></i>
            Add Candidate
        </x-app.button>
    </div>

    {{-- Candidates table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Position</x-table.thead>
            <x-table.thead>Candidate/s</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($positions as $position)
                <tr>
                    <x-table.tdata>{{ $position->name }}</x-table.tdata>
                    <x-table.tdata>
                        <div class="space-y-2">
                            @forelse ($position->candidates as $candidate)
                                <div class="flex items-center justify-between min-w-max gap-x-2">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                            <img
                                                class="w-full object-cover"
                                                @if (is_null($candidate->user->profile_picture))
                                                    src="{{ url(asset('assets/default-img.png')) }}"
                                                @else
                                                    src="{{ url(asset($candidate->user->profile_picture)) }}"
                                                    @endif
                                                    alt="profile_picture" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $candidate->user->fullname }}
                                                    </p>
                                                </div>
                                        </div>
                                    <div>
                                        <x-table.delete-btn />
                                        <x-table.edit-btn type="button" />
                                    </div>
                                </div>
                            @empty
                                No candidates found
                            @endforelse
                        </div>
                    </x-table.tdata>
                </tr>
            @empty
                <x-table.tdata>No candidates found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $positions->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add Candidate --}}
    @livewire('officers.candidate-form', ['electionId' => $election->id])
</div>
