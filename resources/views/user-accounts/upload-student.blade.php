<x-app-layout :scripts="$scripts">
    <x-page-title>{{ $title }}</x-page-title>

    {{-- Livewire import student blade --}}
    {{-- @livewire('import-student') --}}

    <div class="w-1/2 mx-auto">
        <h1 class="text-center text-3xl font-semibold">Import Students</h1>

        <form
            action="{{ route('import-users') }}"
            {{-- wire:submit.prevent="importStudents" --}}
            method="POST"
            enctype="multipart/form-data"
            id="upload-student-form">
            @csrf

            {{-- Alert Message --}}
            @if(session('status'))
                <div class="text-white w-full bg-{{ session('status') }}-500 rounded px-2 py-1">{{ session('message') }}</div>
            @endif

            {{-- Select School --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">School</label>
                <select name="school" id="school-container" class="w-full rounded" value="{{ old('school') }}">
                    <option value="">--select school--</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>

                @error('school')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>


            {{-- Select specialization --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Specialization</label>
                <select name="specialization" id="specialization-container" class="w-full rounded">
                    <option value="">--select specialization--</option>
                </select>

                @error('specialization')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload an csv file --}}
            <div class="text-center mb-3">
                <label for="file" class="block">Upload File</label>
                <input type="file" name="file" id="file" class="border-2 border-black rounded mb-2" required/>

                @error('file')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-xs text-center">
                <p class="font-thin italic">The file type must be CSV</p>
                <p class="font-thin italic">Download <a href="/download"><span class="text-blue-700">here </span></a>for an example format.</p>
            </div>

            <div class="p-3 mt-2 text-center space-x-4 md:block">
                <a href="{{ route('add-student') }}" class="inline-block rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Import</button>
            </div>
        </form>
    </div>
</x-app-layout>
