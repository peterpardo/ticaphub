<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <form 
        action="/schedules/create"
        method="post">
        @csrf
        <div class="w-1/2 mx-auto rounded shadow px-4 py-3 mt-2">
            @if(session('status'))
                <div class="bg-{{ session('status') }}-300 rounded px-2 py-5 text-center text-white">{{ session('message') }}</div>
            @endif
            <h1 class="font-semibold text-2xl">Create Schedule</h1>
            <div>
                <label class="block my-2">Event Name:</label>
                <input type="text" name="name" class="w-full rounded resize-none" value="{{ old('name') }}">
                @error('name')
                    <div class="bg-red-500 rounded px-2 py-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <div>
                    <label class="block">Set date:</label>
                    <input name="start_date" type="date" class="rounded" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex">
                    <div class="mr-2">
                        <label class="block">Set Start Time</label>
                        <input name="start_time" type="time" class="rounded" value="{{ old('start_time') }}">
                        @error('start_time')
                            <div class="bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block">Set End Time</label>
                        <input name="end_time" type="time" class="rounded" value="{{ old('end_time') }}">
                        @error('end_time')
                            <div class="bg-red-500 rounded px-2 py-1 text-white my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
            </div>
            <div class="my-2 text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 rounded px-2 py-1 text-white">Submit</button>
            </div>
        </div>
    </form>   
</x-app-layout>