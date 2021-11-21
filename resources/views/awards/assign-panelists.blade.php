<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <form 
        action="/set-panelist/assign" 
        method="post"
        id="panelistForm">
        @csrf
        <div class="bg-white text-gray-800 w-2/5 px-3 py-4 mx-auto rounded shadow">
            <h1 class="font-bold my-2 text-xl text-center">Set Panelists</h1>
            <div class="mb-2">
                <label class="font-semibold block">Specializations</label>
                <select id="spec" name="specialization" class="w-full rounded my-2">
                    <option value="">--- select specialization ---</option>
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
                </label>
                @if(session('status'))
                <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4" role="alert">
                    <p class="font-bold">{{ session('message') }}</p>
                  </div>
                @endif
                @error('panelists')
                    <div class="bg-red-500 text-white px-2 py-1 my-1 rounded">{{ $message }}</div>
                @enderror
                <div id="message"></div>
                <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full table-auto" id="panelistTable">
                            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                                <td class="px-4 border">
                                    <select name="panelists[]" class="w-full rounded my-2">
                                        <option value="">--- select panelist ---</option>
                                        @foreach ($panelists as $panelist)
                                            <option value="{{ $panelist->id }}">{{ $panelist->first_name }} {{ $panelist->middle_name }} {{ $panelist->last_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <a id="addBtn" class="inline-block cursor-pointer bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-2">+ panelist</a>
            <div class="text-center">
                <a href="/set-panelist" class="inline-block shadow rounded text-black px-2 py-2 mr-3">Cancel</a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-2">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>