<div class="space-y-2" x-data="{
    showUpdateAwardModal: @entangle('showUpdateAwardModal').defer,
    showEndAwardModal: @entangle('showEndAwardModal').defer,
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

   {{-- Specialization name --}}
   <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="flex gap-x-1 self-end md:self-auto">
            <x-app.button color="gray" wire:click.prevent="showConfirmModal('updateAwards')">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Update Awards
            </x-app.button>
            <x-app.button color="green" wire:click.prevent="endAwarding('endAward')">
                End Awarding
                <i class="fa-solid fa-arrow-right ml-1"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can see all of the panelist for this specialization, whether they are finished evaluating or not.
    </x-info-box>

    {{-- Table --}}
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
                    <x-table.tdata>{{ $panelist->user->fullname }}</x-table.tdata>
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

    {{-- Modals --}}
    {{-- Update award --}}
    <div x-cloak x-show="showUpdateAwardModal">
        <x-modal>
            <x-modal.title>Update Awards</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will reset the grades entered by the panelists. Make sure to inform the panelists before continuing</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showUpdateAwardModal = false">Cancel</x-app.button>
                <x-app.button color="green" wire:click.prevent="updateAwards">Yes, update awards.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>