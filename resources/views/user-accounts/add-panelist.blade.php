<x-app-layout>
    <div>
        {{-- ADD ADMIN FORM --}}
        <h1 class="font-bold text-center text-3xl my-4">Add Panelist</h1>
        <div class="w-full">
            <form 
                action="{{ route('add-panelist') }}"
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
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
                    <input type="text" name="middle_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('middle_name') }}" autocomplete="off">
                    @error('middle_name')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
                    <input type="text" name="last_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('last_name') }}" autocomplete="off">
                    @error('last_name')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Email</label>
                    <input type="email" name="email" class="rounded w-full text-gray-900 dark:text-black" value="{{ old('email') }}" autocomplete="off">
                    @error('email')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-evenly my-3">
                    <a href="{{ route('users') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block text-gray-800 rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Add</button>
                </div>
            </form>
        </div>
        {{-- ADD ADMIN FORM --}}
    </div>
</x-app-layout>