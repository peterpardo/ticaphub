<x-app-layout>
    {{-- <x-page-title>{{ $title }}</x-page-title> --}}
    <div>
        {{-- ADD ADMIN FORM --}}
        <h1 class="font-bold text-center text-3xl my-4">Add Admin</h1>
        <div class="w-full">
            <form 
                action="{{ route('add-admin') }}"
                method="POST"
                class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
                @csrf
                @if(session('status'))
                <div class="text-white w-full rounded py-1 px-2 bg-green-500">{{ session('message') }}</div>
                @endif
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">First Name</label>
                    <input type="text" name="first_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('first_name') }}" autocomplete="off">
                    @error('first_name')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
                    <input type="text" name="middle_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('middle_name') }}" autocomplete="off">
                    @error('middle_name')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
                    <input type="text" name="last_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('last_name') }}" autocomplete="off">
                    @error('last_name')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Email</label>
                    <input type="email" name="email" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('email') }}" autocomplete="off">
                    @error('email')
                    <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">School</label>
                    <select name="school" class="w-full rounded font-semibold text-base text-gray-900 dark:text-gray-900" wire:model="selectedSchool">
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
                <div class="text-center">
                    <button type="submit" class="md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">Submit</button>
                </div>
            </form>
        </div>
        {{-- ADD ADMIN FORM --}}
    </div>
</x-app-layout>