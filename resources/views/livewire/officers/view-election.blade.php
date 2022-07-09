<div class="space-y-2" x-data="{
    showResetModal: @entangle('showResetModal').defer,
    showConfirmModal: @entangle('showConfirmModal').defer,
}">
    {{-- Election name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $election->name }}</h1>

        {{-- Functions for admin only --}}
        @hasanyrole('superadmin|admin')
            <div class="flex gap-x-1 self-end md:self-auto">
                <x-app.button type="button" color="gray" @click.prevent="showResetModal = !showResetModal">
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                    Reset Election
                </x-app.button>
                <x-app.button type="button" color="green">
                    End Election
                    <i class="fa-solid fa-arrow-right ml-1"></i>
                </x-app.button>
            </div>
        @endhasanyrole
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can see the status of the election. The vote count will automatically update every two seconds.
    </x-info-box>

    {{-- Candidates table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Position</x-table.thead>
            <x-table.thead>Candidate/s</x-table.thead>
            <x-table.thead>No. of Votes</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($positions as $position)
                <tr>
                    {{-- Position --}}
                    <x-table.tdata>{{ $position->name }}</x-table.tdata>

                    {{-- Candidate --}}
                    <x-table.tdata>
                        <div class="space-y-2">
                            @forelse ($position->candidates as $candidate)
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
                            @empty
                                No candidates found
                            @endforelse
                        </div>
                    </x-table.tdata>

                    {{-- Vote Count --}}
                    <x-table.tdata>
                        <div class="space-y-2">
                            @foreach ($position->candidates as $candidate)
                                <div class="flex items-center h-10">{{ $candidate->votes_count }}</div>
                            @endforeach
                        </div>
                    </x-table.tdata>
                </tr>
            @empty
                <x-table.tdata>No positions found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $positions->links() }}
        </x-slot>
    </x-table>


    {{-- Modals --}}
    {{-- Reset election --}}
    <div x-cloak x-show="showResetModal">
        <x-modal>
            <x-modal.title>Reset Electoin</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will reset all of the current votes of each candidate.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showResetModal = !showResetModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="resetElection">Yes, reset election.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
