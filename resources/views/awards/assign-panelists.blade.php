<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <a href="/set-panelist" class="inline-block bg-red-500 hover:bg-red-600 rounded text-white px-2 py-2">Back</a>
    <form 
        action="/set-panelist/assign" 
        method="post"
        id="panelistForm">
        @csrf
        <div class="w-2/5 px-3 py-4 mx-auto rounded shadow">
            <h1 class="font-bold my-2 text-xl text-center">Set Panelists</h1>
            <div class="mb-2">
                <label class="font-semibold block">Specializations</label>
                <select id="spec" name="specialization" class="w-full rounded my-2">
                    <option value="">-- select specialization</option>
                    @foreach ($specs as $spec)
                        <option value="{{ $spec->id }}">{{ $spec->name }} ({{ $spec->school->name }})</option>
                    @endforeach
                </select>
                <div id="specMsg"></div>
                @error('specialization')
                    <div class="bg-red-500 text-white px-2 py-1 my-1 rounded">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label class="font-semibold block">
                    Panelists
                    <a id="addBtn" class="inline-block cursor-pointer bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-2">+ panelist</a>
                </label>
                @if(session('status'))
                    <div class="bg-{{ session('status') }}-500 px-2 py-1 rounded text-white mt-1">{{ session('message') }}</div>
                @endif
                @error('panelists')
                    <div class="bg-red-500 text-white px-2 py-1 my-1 rounded">{{ $message }}</div>
                @enderror
                <div id="message"></div>
                <table class="w-full" id="panelistTable">
                    <tr>
                        <td>
                            <select name="panelists[]" class="w-full rounded my-2">
                                <option value="">-- select specialization</option>
                                @foreach ($panelists as $panelist)
                                    <option value="{{ $panelist->id }}">{{ $panelist->first_name }} {{ $panelist->middle_name }} {{ $panelist->last_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-2">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>