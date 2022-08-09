<div x-data="{
    showRubricForm: @entangle('showRubricForm'),
}">
    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can create rubrics and set the criteria.
    </x-info-box>

    <div class="flex justify-between">
        <x-app.button type="link" color="red" href="{{ url('project-assessment') }}" >
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>

        <x-app.button color="green" wire:click.prevent="showRubricForm">
            <i class="fa-solid fa-plus mr-1"></i>
            Add Rubric
        </x-app.button>
    </div>

    {{-- Rubrics Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Name</x-table.thead>
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
                        <x-table.delete-btn wire:click="selectItem({{ $position->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('project-assessment.rubric-form', 'showModal', 'edit')"/>
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
    {{-- Add Rubric --}}
    <div x-cloak x-show="showRubricForm">
        @livewire('project-assessment.rubric-form')
    </div>

    {{-- Scripts --}}
    @push('scripts')
        <script>
            const addCriteriaBtn = document.getElementById('addCriteriaBtn');
            const criteriaList = document.getElementById('criteriaList');
            let count = 1;

            addCriteriaBtn.addEventListener('click', e => {
                e.preventDefault();
                const div = document.createElement('div');
                div.setAttribute('class', 'flex gap-x-2 items-end');
                div.innerHTML = `
                    <x-form.form-control>
                        <x-form.label class="text-sm md:text-base" for="critName">Criteria Name</x-form.label>
                        <x-form.input wire:model.defer="critName.${count}" id="critName" />
                    </x-form.form-control>
                    <x-form.form-control>
                        <x-form.label class="text-sm md:text-base" for="critPerc">Criteria Percentage</x-form.label>
                        <x-form.input wire:model.defer="critPerc.${count}" id="critPerc" />
                    </x-form.form-control>
                    <div class="flex items-end">
                        <x-app.button color="red" wire:click.prevent="deleteCriteria(${count})"><i class="fa-solid fa-trash-can"></i></x-app.button>
                    </div>
                `
                criteriaList.appendChild(div);
                count++;
                console.log(criteriaList);
            });


        </script>
    @endpush
</div>
