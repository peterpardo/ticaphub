<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div class="w-1/2 mx-auto">
        <h1 class="font-bold text-5xl text-center mb-5" >Add Multiple Users</h1>

        <form 
            action="{{ route('invite-users') }}"
            method="POST"
            enctype="multipart/form-data">
        @csrf

        <div class="text-center mb-3">
            @if(session('status'))
            <div>
                <span class="text-{{ session('status') }}-600">{{ session('msg') }}</span>
            </div>
            @endif
            @error('file')
                <span class="block text-red-600">{{ $message }}</span>
            @enderror
            <label for="file" class="block">Upload File</label>
            <input type="file" name="file" class="border-2 border-black rounded mb-2"/>
        </div>

        <div class="text-center">
            <button type="submit" class="px-5 py-2 bg-green-600 text-white hover:bg-green-500 rounded">Invite</button>
        </div>
        </form>
    </div>
</x-app-layout>