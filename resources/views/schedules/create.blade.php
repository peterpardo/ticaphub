<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <a href="/schedules" class="bg-red-500 px-2 py-1 hover:bg-red-600 text-white rounded">Back</a>
    <form 
        action="/schedules/create"
        method="post">
        @csrf
        <div class="w-1/2 mx-auto rounded shadow px-4 py-3 mt-2">
            <h1 class="font-semibold text-2xl">Create Schedule</h1>
            @if(session('status'))
                <div class="bg-{{ session('status') }}-500 rounded px-2 py-5 text-center my-1 text-white">{{ session('message') }}</div>
            @endif
            <div>
                <label class="block">Event Name</label>
                <input type="text" name="name" class="w-full rounded resize-none" value="{{ old('name') }}">
                @error('name')
                    <div class="bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex mt-2">
                <div class="mr-2">
                    <label class="block">Start date</label>
                    <input name="start_date" type="date" class="rounded" value="{{ old('start_date') }}">
                    @error('start_date')
                    <span class="inline-block bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block">End date</label>
                    <input name="end_date" type="date" class="rounded" value="{{ old('end_date') }}">
                    @error('end_date')
                    <span class="inline-block bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="my-2 text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 rounded px-2 py-1 text-white">Submit</button>
            </div>
        </div>
    </form>   
</x-app-layout>