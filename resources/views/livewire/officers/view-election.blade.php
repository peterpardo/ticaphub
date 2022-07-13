<div class="space-y-2" x-data="{
    showResetModal: @entangle('showResetModal').defer,
    showConfirmModal: false,
    showRedoModal: false,
    showFinalModal: false,
}">
    {{-- Election name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $election->name }}</h1>

        {{-- Functions for admin only --}}
        @hasanyrole('superadmin|admin')
            <div class="flex gap-x-1 self-end md:self-auto">
                <x-app.button type="button" color="gray" @click.prevent="showResetModal = !showResetModal">
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                    Update Election
                </x-app.button>

                {{-- Check if election is 'in_review' --}}
                @if ($election->in_review)
                    {{-- If there are still tied candidates, show re-do election --}}
                    @if ($hasTiedCandidates)
                        <x-app.button type="button" color="blue" @click.prevent="showRedoModal = !showRedoModal">
                            Redo Election
                            <i class="fa-solid fa-arrow-right ml-1"></i>
                        </x-app.button>
                    @else
                        <x-app.button type="button" color="green" @click.prevent="showFinalModal = !showFinalModal">
                            Finalize Election
                            <i class="fa-solid fa-arrow-right ml-1"></i>
                        </x-app.button>
                    @endif
                @else
                    <x-app.button type="button" color="green" @click.prevent="showConfirmModal = !showConfirmModal">
                        End Election
                        <i class="fa-solid fa-arrow-right ml-1"></i>
                    </x-app.button>
                @endif
            </div>
        @endhasanyrole
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    @if ($election->in_review)
        <x-info-box color="yellow">
            @if (auth()->user()->hasAnyRole('superadmin', 'admin'))
                Currently, the election has been finished and is now in review. If their are positions with tied votes, redo of election for that position must be done by clicking the <strong>Redo Election</strong> button.
            @else
                This table shows the result of the election.
            @endif
        </x-info-box>
    @else
        <x-info-box color="yellow">
            Here, you can see the status of the election. The vote count will automatically update every five seconds.
        </x-info-box>
    @endif

    {{-- Student count --}}
    {{-- Refresh page only when voting is still ongoing --}}
    <div @if (!$election->in_review) wire:poll.5000ms="updateVotes" @endif>
        <strong>{{ $studentHasVotedCount }}</strong> out of <strong>{{ $studentCount }}</strong> has voted
    </div>

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
                                <div class="flex items-center @if ($candidate->status) bg-{{ $candidate->status }}-100 rounded-full @endif">
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

        <x-slot name="links"></x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Reset election --}}
    <div x-cloak x-show="showResetModal">
        <x-modal>
            <x-modal.title>Update Election</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will reset all of the current votes of each candidate.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showResetModal = !showResetModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="resetElection">Yes, reset election.</x-app.button>
            </div>
        </x-modal>
    </div>

    {{-- End election --}}
    <div x-cloak x-show="showConfirmModal">
        <x-modal>
            <x-modal.title>End Election</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will end the election students will not be able to vote anymore.</x-modal.description>

            {{-- Spinner --}}
            <x-spinner wire:loading.flex wire:target="endElection">Please Wait. This may take a few seconds.</x-spinner>

            <div class="text-right">
                <x-app.button color="gray" wire:loading.attr="disabled" @click.prevent="showConfirmModal = !showConfirmModal">Cancel</x-app.button>
                <x-app.button color="green" wire:loading.attr="disabled" wire:click.prevent="endElection">Yes, end the election.</x-app.button>
            </div>
        </x-modal>
    </div>

    {{-- Redo election --}}
    <div x-cloak x-show="showRedoModal">
        <x-modal>
            <x-modal.title>Redo Election</x-modal.title>
            <x-modal.description>Votes of the positions with tied candidates will be reset to 0 and students will need to vote again to determine the winner.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showRedoModal = !showRedoModal">Cancel</x-app.button>
                <x-app.button color="blue" wire:click.prevent="redoElection">Yes, redo the election.</x-app.button>
            </div>
        </x-modal>
    </div>


    {{-- Finalize election --}}
    <div x-cloak x-show="showFinalModal">
        <x-modal>
            <x-modal.title>Finalize Election</x-modal.title>
            <x-modal.description>Are you sure? All the winners will be assigned as officers for this election and will given access to the <strong>Manage Events</strong> link.</x-modal.description>

            {{-- Spinner --}}
            <x-spinner wire:loading.flex wire:target="finalizeElection">Please Wait. This may take a few seconds.</x-spinner>

            <div class="text-right">
                <x-app.button color="gray" wire:loading.attr="disabled" @click.prevent="showFinalModal = !showFinalModal">Cancel</x-app.button>
                <x-app.button color="green" wire:loading.attr="disabled" wire:click.prevent="finalizeElection">Yes, finalize the election.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
