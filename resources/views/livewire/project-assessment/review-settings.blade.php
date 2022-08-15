<div class="space-y-2"  x-data="{
    showConfirmModal: @entangle('showConfirmModal').defer
}">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="flex gap-x-1 self-end md:self-auto">
            <x-app.button type="link" href="{{ url('project-assessment/set-panelists/' . $specialization->id) }}" color="gray">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Set Panelists
            </x-app.button>
            <x-app.button color="green" @click.prevent="showConfirmModal = !showConfirmModal">
                Start Awarding
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
        Before starting the evaluation of groups, make sure the following conditions are met: <br/>
        - The selected specialization has groups/capstone groups. Go to <strong>(User Accounts > Groups)</strong> <br/>
        - All groups/capstone groups must have an assigned <strong>Project Adviser</strong>. Go to <strong>(User Accounts > Project Advisers)</strong> <br/>
        - There must be awards and panelists set.
    </x-info-box>

    {{-- Check groups without project adviser --}}
    @if ($groupsWithoutAdviser->count() > 0)
        <x-alert.basic-alert color="red" message="Some groups don't have any assigned Project Advisers"/>
    @endif

    {{-- Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead></x-table.thead>
                <x-table.thead></x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            <tr>
                <x-table.tdata>No. of Groups</x-table.tdata>
                <x-table.tdata>
                    @if ($groupCount <= 0)
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                            <span class="relative">none</span>
                        </span>
                    @else
                        {{ $groupCount }}
                    @endif
                </x-table.tdata>
            </tr>
            <tr>
                <x-table.tdata>No. of Awards</x-table.tdata>
                <x-table.tdata>
                    @if ($awardCount <= 0)
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                            <span class="relative">none</span>
                        </span>
                    @else
                        {{ $awardCount }}
                    @endif
                </x-table.tdata>
            </tr>
            <tr>
                <x-table.tdata>No. of Panelists</x-table.tdata>
                <x-table.tdata>
                    @if ($panelistCount <= 0)
                        <span
                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                            <span class="relative">none</span>
                        </span>
                    @else
                        {{ $panelistCount }}
                    @endif
                </x-table.tdata>
            </tr>
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>

    {{-- Mdoals --}}
    {{-- Start awarding --}}
    <div x-cloak x-show="showConfirmModal">
        <x-modal>
            <x-modal.title>Start Awarding</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will allow the panelists to evaluate the groups. You can still update the settings but will reset the grades of all the groups.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" @click.prevent="showConfirmModal = false">Cancel</x-app.button>
                <x-app.button color="green" wire:click.prevent="startAwarding">Yes, start awarding.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
