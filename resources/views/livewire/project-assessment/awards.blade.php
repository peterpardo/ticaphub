<div class="space-y-2">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="self-end md:self-auto">
            <x-app.button type="link" href="{{ url('project-assessment/set-panelists/' . $specialization->id) }}" color="indigo">
                Set Panelists
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
        <br/>- For the first step, create awards by clicking the <strong>Add Award</strong> button. Make sure that you have rubrics for your awards (Go to the <strong>Project Assessment</strong> page).
        <br/>- <strong>*IMPORTANT*</strong> Awards such as <strong>BEST CAPSTONE PROJECT</strong>, <strong>BEST PRESENTER</strong>, and <strong>BEST PROJECT ADVISER</strong> are automatically created by default for each specializations. Just assign a rubric for the said awards.
        <br/>- <strong>*IMPORTANT*</strong> All awards listed here can only be evaluated by panelists or invited guests. Awards such as the <strong>STUDENT CHOICE AWARD</strong> are temporarily not included in this module.
    </x-info-box>

    {{-- Add award button --}}
    <x-app.button color="green" wire:click.prevent="$emitTo('project-assessment.award-form', 'showModal', 'add')">
        <i class="fa-solid fa-plus mr-1"></i>
        Add Award
    </x-app.button>

    {{-- Awards Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Award Name</x-table.thead>
                <x-table.thead>Rubric</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($awards as $award)
                <tr>
                    <x-table.tdata>{{ $award->name }}</x-table.tdata>
                    <x-table.tdata>
                        {{-- Check if award has a rubric --}}
                        @if (is_null($award->rubric_id))
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden
                                    class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                <span class="relative">none</span>
                            </span>
                        @else
                            {{ $award->rubric->name }}
                        @endif
                    </x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="selectItem({{ $award->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="#"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No awards are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $awards->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add award --}}
    <livewire:project-assessment.award-form :specializationId="$specialization->id"/>
</div>
