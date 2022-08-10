<div x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can create rubrics and set the criteria.
    </x-info-box>

    <div class="flex justify-between">
        <x-app.button type="link" color="red" href="{{ url('project-assessment') }}" >
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>

        <x-app.button color="green" wire:click.prevent="$emitTo('project-assessment.rubric-form', 'showModal', 'add')">
            <i class="fa-solid fa-plus mr-1"></i>
            Add Rubric
        </x-app.button>
    </div>

    {{-- Rubrics Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Rubric Name</x-table.thead>
                <x-table.thead>Criteria Count</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($rubrics as $rubric)
                <tr>
                    <x-table.tdata>{{ $rubric->name }}</x-table.tdata>
                    <x-table.tdata>{{ $rubric->criteria_count }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="selectItem({{ $rubric->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('project-assessment.rubric-form', 'showModal', 'edit', {{ $rubric->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No rubrics are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add/Update Rubric --}}
    @livewire('project-assessment.rubric-form')

    {{-- Delete Rubric --}}
    {{-- Delete user --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Rubric</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the rubric.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete rubric.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
