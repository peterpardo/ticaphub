<div class="space-y-2" x-data="{
    showConfirmModal: @entangle('showConfirmModal').defer,
}">
    {{-- Election name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $election->name }}</h1>

        <div class="flex gap-x-1 self-end md:self-auto">
            <x-app.button type="link" href="{{ url('officers/set-candidates/' . $election->id) }}" color="gray">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Set Candidates
            </x-app.button>
            <x-app.button type="button" color="green" @click.prevent="showConfirmModal = !showConfirmModal">
                Start Election
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
        You can review the list of candidates that you have set here. Make sure that all positions have atleast two candidates. You can still update the positions and candidates once the election has started but the election will be reset and the votes will be invalid.
    </x-info-box>

    <h2 class="text-lg font-semibold">Review Election</h2>

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
    {{-- Confirm election --}}
    {{-- Confirm modal --}}
    <div x-cloak x-show="showConfirmModal">
        <x-modal>
            <x-modal.title>Election Settings</x-modal.title>
            <x-modal.description>Do you want to start the election with these candidates? Make sure that each positions has candidates.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showConfirmModal = !showConfirmModal">Cancel</x-app.button>
                <x-app.button color="green" wire:click.prevent="confirmSettings">Yes, start the election.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
