
<div>
    <h1 class="font-bold text-center text-3xl my-4">Add Student</h1>
    {{-- ADD STUDENT FORM --}}
    <div class="w-full">
        <form 
            action=""
            method="POST"
            class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
            @csrf
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Student Number</label>
                <input type="text" name="student_number" class="rounded w-full" value="{{ old('student_number') }}" autocomplete="off">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">First Name</label>
                <input type="text" name="first_name" class="rounded w-full" value="{{ old('first_name') }}" autocomplete="off">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Middle Name</label>
                <input type="text" name="middle_name" class="rounded w-full" value="{{ old('middle_name') }}" autocomplete="off">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Last Name</label>
                <input type="text" name="last_name" class="rounded w-full" value="{{ old('last_name') }}" autocomplete="off">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Email</label>
                <input type="email" name="email" class="rounded w-full" value="{{ old('email') }}" autocomplete="off">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">School</label>
                <select name="school" class="w-full rounded" wire:model="selectedSchool">
                    <option value="">--select school--</option>
                    @foreach ($schools as $school)
                    @if($school->is_involved)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @if($selectedSchool != "" && !is_null($selectedSchool) )
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Specialization</label>
                <select name="specialization" class="w-full rounded" wire:model="selectedSpec">
                    <option value="">--select specialization--</option>
                    @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if($selectedSpec != "" && !is_null($selectedSpec))
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Group</label>
                <select name="group" class="rounded w-full">
                    <option value="">--select group--</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <button type="submit" class="rounded bg-green-500 hover:bg-green-600 text-white px-2 py-1 w-full mb-2">Submit</button>
        </form>
    </div>
    {{-- ADD STUDENT FORM --}}

    {{-- UPLOAD STUDENTS MODAL --}}
    {{-- <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="uploadFormModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div>
                <form 
                    action="{{ route('import-users') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        @error('school')
                        <div class="text-red-500"></div>
                        @enderror
                        <label for="school">School</label>
                        <select name="school" id="school">
                            @foreach($schools as $school)
                            @if($school->is_involved)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        @error('specialization')
                        <div class="text-red-500"></div>
                        @enderror
                        <label for="specialization">School</label>
                        <select name="specialization" id="specialization">
                            @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center mb-3">
                        @error('file')
                        <div class="text-red-500"></div>
                        @enderror
                        <label for="file" class="block">Upload File</label>
                        <input type="file" name="file" id="file" class="border-2 border-black rounded mb-2" required/>
                    </div>
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <button wire:click.prevent="closeModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Invite</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    {{-- UPLOAD STUDENTS MODAL --}}
</div>

   

    

