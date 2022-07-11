<div class="space-y-2" x-data="{
    showConfirmModal: @entangle('showConfirmModal').defer
}">
    {{-- Alert --}}
    @if (session('status'))
       <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif


    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can vote for candidates that you want to win for the specified position they are running for. Please vote wisely.
    </x-info-box>

    {{-- Submit vote button --}}
    <div class="text-right">
        <x-app.button color="green" wire:click.prevent="$set('showConfirmModal', true)">
            <i class="fa-solid fa-check mr-1"></i>
            Confirm Vote
        </x-app.button>
    </div>

    {{-- Candidates table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Position</x-table.thead>
            <x-table.thead>Candidate/s</x-table.thead>
            <x-table.thead>Vote</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($positions as $position)
                <tr>
                    <x-table.tdata>{{ $position->name }}</x-table.tdata>
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

                    {{-- Vote radio button --}}
                    <x-table.tdata>
                        <div class="space-y-2">
                            @foreach ($position->candidates as $candidate)
                                <div class="flex items-center h-10">
                                    <input type="radio" wire:model="positionProps.{{ $position->position_slug }}" value="{{ $candidate->id }}"/>
                                </div>
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
    {{-- End election --}}
    <div x-cloak x-show="showConfirmModal">
        <x-modal>
            <x-modal.title>Confirm Vote</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will submit your vote and you won't be able to change it anymore.</x-modal.description>

            {{-- Spinner --}}
            <x-spinner wire:loading.flex wire:target="endElection">Please Wait. This may take a few seconds.</x-spinner>

            <div class="text-right">
                <x-app.button color="gray" wire:loading.attr="disabled" wire:click.prevent="$set('showConfirmModal', false)">Cancel</x-app.button>
                <x-app.button color="green" wire:loading.attr="disabled" wire:click.prevent="submitVote">Yes, submit vote.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
