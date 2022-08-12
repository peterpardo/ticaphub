<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="saveAward">
                @if ($action == 'add')
                    <x-form.title>Add Award</x-form.title>
                @else
                    <x-form.title>Edit Award</x-form.title>
                @endif

                {{-- Alert --}}
                @if (session('status'))
                    <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
                @endif

                {{-- Award name --}}
                <x-form.form-control>
                    <x-form.label for="name">Award Name</x-form.label>
                    <x-form.input wire:model.lazy="name" id="name" placeholder="e.g. Best Website Design"/>
                    @error('name')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Rubric --}}
                <x-form.form-control>
                    <x-form.label for="rubric">Rubric Name</x-form.label>
                    <x-form.input-info><strong>Note:</strong> If there are no listed rubrics, go to <strong>Project Assessment > View Rubrics > Add Rubric</strong>.</x-form.input-info>
                    <x-form.select wire:model="rubric" id="rubric">
                        <option value="">--- select a rubric ---</option>
                        @foreach ($rubrics as $rubric)
                            <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                        @endforeach
                    </x-form.select>
                    @error('rubric')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Rubric preview --}}
                @if (!is_null($rubricPreview))
                    <x-modal.table>
                        <x-slot name="heading">
                            <x-modal.table.thead>Criteria</x-modal.table.thead>
                            <x-modal.table.thead>Score</x-modal.table.thead>
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($rubricPreview->criteria as $crit)
                                <tr>
                                    <x-modal.table.tdata>{{ $crit->name }}</x-modal.table.tdata>
                                    <x-modal.table.tdata>{{ $crit->percentage}}</x-modal.table.tdata>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-modal.table>
                @endif

                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" type="submit">Save changes</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
