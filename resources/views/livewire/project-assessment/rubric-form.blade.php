<div>
    <x-modal>
        {{-- Form --}}
        <x-form wire:submit.prevent="saveRubric">
            @if ($action == 'add')
                <x-form.title>Add Rubric</x-form.title>
            @else
                <x-form.title>Edit Rubric</x-form.title>
            @endif

            <x-info-box color="yellow">
                Make sure that the overall points/percentage is equal to <strong>100</strong>.
            </x-info-box>

            {{-- Rubric name --}}
            <x-form.form-control>
                <x-form.label for="name">Rubric Name</x-form.label>
                <x-form.input-info><strong>Note:</strong> Name the rubric which will let you easily remember the criteria in it.</x-form.input-info>
                <x-form.input wire:model.lazy="name" id="name" />
                @error('name')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            {{-- Add crtiria button --}}
            <div class="text-right">
                <x-app.button color="green" id="addCriteriaBtn">
                    <i class="fa-solid fa-plus mr-1"></i>
                    Add Criteria Box
                </x-app.button>
            </div>

            {{-- Criteria --}}
            <div id="criteriaList">
                {{-- <div class="flex gap-x-2 items-end">
                    <x-form.form-control>
                        <x-form.label class="text-sm md:text-base" for="critName">Criteria Name</x-form.label>
                        <x-form.input wire:model.defer="critName.0" id="critName" />
                    </x-form.form-control>
                    <x-form.form-control>
                        <x-form.label class="text-sm md:text-base" for="critPerc">Criteria Percentage</x-form.label>
                        <x-form.input wire:model.defer="critPerc.0" id="critPerc" />
                    </x-form.form-control>
                    <div class="flex items-end">
                        <x-app.button color="red" wire:click.prevent="deleteCriteria(0)"><i class="fa-solid fa-trash-can"></i></x-app.button>
                    </div>
                </div> --}}
            </div>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="green" type="submit">Save changes</x-app.button>
            </div>
        </x-form>
    </x-modal>
</div>
