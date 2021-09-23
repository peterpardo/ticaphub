<x-app-layout>
    {{-- <x-page-title>{{ $title }}</x-page-title> --}}
    
    @livewire('add-student')
    {{-- UPLOAD STUDENTS MODAL --}}
    {{-- <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="uploadFormaModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white text-black">
            <div>
                <form 
                    action="{{ route('import-users') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <label class="font-semibold text-base text-gray-900 dark:text-gray-900">School</label>
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
                        <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Specialization</label>
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
                        @error('file')
                        <div class="text-red-500"></div>
                        @enderror
                        <label for="file" class="block">Upload File</label>
                        <input type="file" name="file" id="file" class="border-2 border-black rounded mb-2" required/>
                    </div>
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <a href="javascript;" id="closeUploadBtn" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Invite</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    {{-- UPLOAD STUDENTS MODAL --}}
</x-app-layout>