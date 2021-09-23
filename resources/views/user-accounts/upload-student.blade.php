<x-app-layout>
    <x-page-title>{{ $title }}</x-page-title>
    <div class="w-1/2 mx-auto">
        <h1 class="text-center text-3xl font-semibold">Import Students</h1>
        <form 
            action="{{ route('import-users') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(session('status'))
            <div class="text-white w-full bg-red-500 rounded px-2 py-1">{{ session('message') }}</div>
            @endif
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">School</label>
                <select name="school" class="w-full rounded">
                    <option value="">--select school--</option>
                    @foreach ($schools as $school)
                    @if($school->is_involved)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('school')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Specialization</label>
                <select name="specialization" class="w-full rounded">
                    <option value="">--select specialization--</option>
                    @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
                @error('specialization')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center mb-3">
                <label for="file" class="block">Upload File</label>
                <input type="file" name="file" id="file" class="border-2 border-black rounded mb-2" required/>
                @error('file')
                <div class="text-red-500"></div>
                @enderror
            </div>
            <div class="p-3 mt-2 text-center space-x-4 md:block">
                <a href="/users/add-student" id="closeUploadBtn" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Invite</button>
            </div>
        </form>
    </div>
</x-app-layout>