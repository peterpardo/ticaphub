<x-app-layout :scripts="$scripts">

    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div class="w-1/2 mx-auto">
        <div class="w-full bg-grey-500">
            <div class="container mx-auto py-8">
                <div class="w-96 mx-auto bg-white rounded shadow flex flex-col justify-center items-center text-center">
    
                    <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500">Add Admin
                    </div>
    
            <form 
            action="{{ route('add-admin') }}" 
            method="post">
            @csrf

            {{-- FLASH DATA --}}
            @if(session('status'))
            <div class="text-{{ session('status') }}-500">{{ session('msg') }}</div>
            @endif

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="school">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}"  class=" border rounded w-72 py-2 px-3 text-grey-darker">
                    @error('first_name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="school">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}"  class=" border rounded w-72 py-2 px-3 text-grey-darker">
                    @error('middle_name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="school">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}"  class=" border rounded w-72 py-2 px-3 text-grey-darker">
                    @error('last_name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="school">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class=" border rounded w-72 py-2 px-3 text-grey-darker">
                    @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="school">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class=" border rounded w-72 py-2 px-3 text-grey-darker">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2"  for="school">School</label>
                    <select name="school" id="school" class=" border rounded w-72 py-2 px-3 text-grey-darker">
                        @foreach($schools as $school)
                            @if($school->is_involved)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @if($errors->all())
                    @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                    @endforeach 
                @endif
                <button type="submit" class="bg-green-500 p-3 text-white rounded hover:bg-green-400 mb-2">Add Admin</button>
            </form>   
    </div>         
            </div>
        </div>

    </div>

</x-app-layout>