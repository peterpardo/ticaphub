<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex justify-between mb-2">
        <a href="/set-panelist" class="inline-flex mb-3 rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                    clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>
        <a href="/confirm-awards"
            class="h-10 rounded shadow px-5 py-2 text-white bg-green-500 hover:bg-green-600">Confirm Settings</a>
    </div>

    @if (session('status'))
        <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4"
            role="alert">
            <p class="font-bold">{{ session('message') }}</p>
        </div>
    @endif

    {{-- PANELIST REVIEW --}}
    <h1 class="mb-2 text-center font-semibold text-xl">Panelists Review</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed text-center">
            <thead>
                <tr
                    class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">No. of Panelists</th>
                    <th class="px-4 py-3">Student Choice Award</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($specs as $spec)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-md font-bold border">
                            {{ $spec->name . ' (' . $spec->school->name . ')' }}</td>
                        <td class="px-4 py-3 text-md border">
                            @if (!$spec->panelists()->exists() || $spec->panelists->count() == 0)
                                <span class="text-red-500">Empty</span>
                            @else
                                {{ $spec->panelists->count() }}
                            @endif
                        </td>
                        <td class="px-4 py-3 text-md border">
                            <span class="text-green-500">Ok</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- AWARD AND RUBRIC REVIEW --}}
    <h1 class="mb-2 text-center font-semibold text-xl">Award Review</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed text-center">
            <thead>
                <tr
                    class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">Awards</th>
                    <th class="px-4 py-3">Rubric Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($specs as $spec)
                    @foreach ($spec->awards as $award)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-md font-bold border">
                                {{ $spec->name . ' (' . $spec->school->name . ')' }}</td>
                            <td class="px-4 py-3 text-md border">{{ $award->name }}</td>
                            @if ($award->awardRubric()->exists())
                                <td class="px-4 py-3 text-md border"><span class="text-green-500">Ok
                                        ({{ $award->awardRubric->rubric->name }})
                                    </span></td>
                            @else
                                <td class="px-4 py-3 text-md border"><span class="text-red-500">Empty</span></td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- GROUP PROJECT ADVISERS --}}
    <h1 class="mb-2 text-center font-semibold text-xl">Group Project Advisers</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed text-center">
            <thead>
                <tr
                    class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">Group</th>
                    <th class="px-4 py-3">Project Adviser</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($specs as $spec)
                    @foreach ($spec->groups as $group)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-md font-bold border">
                                {{ $spec->name . ' (' . $spec->school->name . ')' }}</td>
                            <td class="px-4 py-3 text-md border">{{ $group->name }}</td>
                            @if ($group->adviser)
                                <td class="px-4 py-3 text-md border"><span
                                        class="font-bold">{{ $group->adviser }}</span></td>
                            @else
                                <td class="px-4 py-3 text-md border"><span class="text-red-500">Not yet set</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
