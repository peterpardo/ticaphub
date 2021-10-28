<div class="mx-auto w-1/2">
    <form class="w-96 mx-auto bg-white rounded shadow px-4 py-2" wire:submit.prevent='updateUserDetails'>
        @csrf
        <div class="my-3">
            <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Profile Picture</label>
            @if(($current_profile && $profile_picture == null) || ($profile_picture->extension() != 'png' && $profile_picture->extension() != 'jpeg' && $profile_picture->extension() != 'jpg'))
                <img src="{{ Storage::URL($current_profile) }}" class="w-1/2 mx-auto my-2" alt="user profile">
            @else
                <img src="{{ $profile_picture->temporaryUrl() }}" class="w-1/2 mx-auto my-2" alt="user profile">
            @endif
            <input type="file" wire:model="profile_picture" class="rounded w-full border text-gray-900 dark:text-black" autocomplete="off">
            <div wire:loading wire:target="profile_picture" class="text-green-500">Uploading...</div>
            @error('profile_picture')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
            @enderror
            @if($profileChanged)
                <div class="my-2 text-right">
                    <button wire:click.prevent="cancelUpdate" class="shadow rounded px-2 py-1 mr-3">Cancel</button>
                    <button wire:click.prevent="updateProfile" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1">Save</button>
                </div>
            @endif
        </div>
        <div class="my-3">
            <label class="font-semibold text-base text-gray-900 dark:text-gray-900">First Name</label>
            <input type="text" wire:model="first_name" class="rounded w-full text-gray-900 dark:text-black" autocomplete="off">
            @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
            @enderror
        </div>
        <div class="my-3">
            <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
            <input type="text" wire:model="middle_name" class="rounded w-full text-gray-900 dark:text-black" autocomplete="off">
            @error('middle_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
            @enderror
        </div>
        <div class="my-3">
            <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
            <input type="text" wire:model="last_name" class="rounded w-full text-gray-900 dark:text-black" autocomplete="off">
            @error('last_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
            @enderror
        </div>
        @role('student')
        <div class="my-3">
            <label class="font-semibold text-base text-gray-900 dark:text-gray-900">ID Number</label>
            <input type="text" wire:model="id_number" class="rounded w-full text-gray-900 dark:text-black" autocomplete="off">
            @error('id_number')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
            @enderror
        </div>
        @endrole
        <div class="text-center">
            <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Update</button>
        </div>
    </form>
</div>
