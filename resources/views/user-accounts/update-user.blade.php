<x-app-layout>
    <h1 class="font-bold text-center text-3xl my-4">Update Profile</h1>
    <div class="mx-auto w-1/2">
        <form class="w-96 mx-auto bg-white rounded shadow px-4 py-2" method="POST" action="{{ route('update.user.profile') }}">
            @csrf
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">First Name</label>
                <input type="text" name="first_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ $user['first_name'] }}" autocomplete="off">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
                <input type="text" name="middle_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ $user['middle_name'] }}" autocomplete="off">
                @error('middle_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
                <input type="text" name="last_name" class="rounded w-full text-gray-900 dark:text-black" value="{{ $user['last_name'] }}" autocomplete="off">
                @error('last_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Update</button>
            </div>
        </form>
    </div>
    </x-app-layout>