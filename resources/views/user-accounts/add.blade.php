<x-app-layout :scripts="$scripts">

    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div class="w-1/2 mx-auto">
        <h1 class="font-bold text-5xl text-center mb-5" >Add User</h1>

        <button type="button" class="bg-green-600 py-2 px-5 mb-3 rounded text-white hover:bg-green-500" id="modal-btn">Upload Users</button>

        @if(session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
        @endif

        @if($errors->all())
            @foreach($errors->all() as $error)
            <div class="text-red-500">{{ $error }}</div>
            @endforeach 
        @endif

        {{-- @if(session()->has('failures'))
        <table class="border-collapse border-2 border-gray-200 bg-red-200">
            <tr>
                <td>Row</td>
                <td>Attributes</td>
                <td>Errors</td>
                <td>Value</td>
            </tr>

            @foreach(session()->get('failures') as $validation)
                <tr>
                    <td>{{ $validation->row() }}</td>
                    <td>{{ $validation->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach($validation->errors() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $validation->values()[$validation->attribute()] }}</td>
                </tr>
            @endforeach
        </table>
        @endif --}}

        @if(session('status'))
            <div class="text-{{ session('status') }}-500">{{ session('msg') }}</div>
        @endif

        @error('file')
        <div class="text-red-500"></div>
        @enderror

        <form 
            action="{{ route('add-user') }}" 
            method="post">
            @csrf

            <div class="mb-2">
                <label for="role">User Role</label>
                <select name="role" id="role">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-2">
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
                <label for="specialization">School</label>
                <select name="specialization" id="specialization">
                    @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                @error('first_name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="school">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}">
            </div>

            <div class="mb-2">
                @error('middle_name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="school">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}">
            </div>

            <div class="mb-2">
                @error('last_name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="school">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}">
            </div>

            <div class="mb-2">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="school">Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="mb-2">
                @error('student_number')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="school">Student Number</label>
                <input type="text" name="student_number" value="{{ old('student_number') }}">
            </div>

            <div class="mb-2">
                @error('group')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <label for="group">Group</label>
                <input type="text" name="group" value="{{ old('group') }}">
            </div>
            
            <button type="submit" class="bg-green-500 p-3 text-white rounded hover:bg-green-400">Add Student</button>
        </form>

  
        {{-- @if(isset($errors) && $errors->any())
        <div class="text-red-500">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif --}}

        {{-- <form 
            action="/users/import-users"
            method="POST"
            enctype="multipart/form-data">
        @csrf

        <div class="text-center mb-3">
            <label for="file" class="block">Upload File</label>
            <input type="file" name="file" class="border-2 border-black rounded mb-2"/>
        </div>

        <!--footer-->
        <div class="p-3 mt-2 text-center space-x-4 md:block">

                <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>

                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Invite</button>

            </div>
            
        </form> --}}


    </div>

    {{-- UPLOAD USERS MODAL OVERLAY --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">

        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>

        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>

                <form 
                    action="{{ route('import-users') }}"
                    method="POST"
                    id="importUserForm"
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


                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">

                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>

                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Invite</button>
 
                 </div>
                 
                </form>
        
            </div>

        </div>

    </div>

</x-app-layout>