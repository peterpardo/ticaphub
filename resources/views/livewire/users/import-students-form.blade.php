
<x-modal>
    <x-form.title>Import Students</x-form.title>

    <x-form wire:submit.prevent="uploadFile">
        {{-- School --}}
        <x-form.form-control>
            <x-form.label for="selectedSchool">School</x-form.label>
            <x-form.select wire:model="selectedSchool" id="selectedSchool">
                @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </x-form.select>
            @error('selectedSchool')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        {{-- Specialization --}}
        <x-form.form-control>
            <x-form.label for="selectedSpecialization">Specialization</x-form.label>
            <x-form.select wire:model="selectedSpecialization" id="selectedSpecialization">
                <option value="" selected>---select specialization---</option>
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                @endforeach
            </x-form.select>
            @error('selectedSpecialization')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        {{-- File upload --}}
        <x-form.form-control>
            <x-form.label for="file">Upload File</x-form.label>
            <span class="block py-1 px-2 rounded bg-gray-100 text-gray-500 text-xs">
                <span class="font-bold">Note:</span> Use this <span wire:click.prevent="downloadTemplate" class="text-blue-700 cursor-pointer font-bold italic hover:text-blue-500 underline">Sample Template</span> in collecting the list of students.
            </span>
            <x-form.input type="file" wire:model="file" id="file"/>
            @error('file')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        <div class="text-right">
            <x-app.button color="gray" @click.prevent="showImportModal = !showImportModal" wire:click.prevent="closeModal">Cancel</x-app.button>
            <x-app.button type="submit" color="green">Upload</x-app.button>
        </div>
    </x-form>

</x-modal>



