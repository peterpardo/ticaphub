<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex justify-between mb-2">
        <a href="/set-panelist" class="inline-block rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Back</a>
        <a href="/confirm-awards" class="inline-block rounded shadow px-5 py-2 text-white bg-green-500 hover:bg-green-600">Confirm Settings</a>
    </div>
    
    @if(session('status'))
        <div class="bg-{{ session('status') }}-200 text-center py-5 my-2 rounded">{{ session('message') }}</div>
    @endif

    {{-- PANELIST REVIEW --}}
    <h1 class="mb-2 text-center font-semibold text-xl">Panelists Review</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed">
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">No. of Panelists</th>
                    <th class="px-4 py-3">Student Choice Award</th>
                </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($specs as $spec)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-md font-bold border">{{ $spec->name . ' (' . $spec->school->name . ')'}}</td>
                <td class="px-4 py-3 text-md border">
                    @if(!$spec->panelists()->exists() || $spec->panelists->count() == 0)
                        <span class="text-red-500">empty</span>
                    @else
                        {{ $spec->panelists->count() }}
                    @endif
                </td>
                <td class="px-4 py-3 text-md border">
                    <span class="text-green-500">ok</span>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- AWARD AND RUBRIC REVIEW --}}
    <h1 class="mb-2 text-center font-semibold text-xl">Award Review</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed">
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">Awards</th>
                    <th class="px-4 py-3">Rubric Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($specs as $spec)
                @foreach($spec->awards as $award)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-md font-bold border">{{ $spec->name . ' (' . $spec->school->name . ')'}}</td>
                        <td class="px-4 py-3 text-md border">{{ $award->name }}</td>
                        @if($award->awardRubric()->exists())
                            <td class="px-4 py-3 text-md border"><span class="text-green-500">ok ({{ $award->awardRubric->rubric->name }})</span></td>
                        @else
                            <td class="px-4 py-3 text-md border"><span class="text-red-500">empty</span></td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>