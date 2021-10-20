<div>
    <a href="{{ route('awards') }}" class="inline-block mb-3 rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Back</a>
    <div class="text-center my-2 font-semibold text-3xl">Set Rubrics</div>
    <div class="flex justify-between">
        <a href="{{ route('rubric') }}" class="inline-block mb-3 rounded shadow px-2 py-2 text-white bg-green-500 hover:bg-green-600">Create Rubric</a>
        <a href="/set-panelist" class="inline-block mb-3 rounded shadow px-2 py-2 text-white bg-green-500 hover:bg-green-600">Proceed to Next Page</a>
    </div>
        @if(session('status'))
    <div class="bg-green-500 px-2 py-1 rounded text-white">{{ session('message') }}</div>
    @endif

    {{-- AWARD TABLE --}}
    <div class="font-semibold">Filter</div>
    <select wire:model="selectedSchool" class="rounded font-semibold text-base text-gray-900 dark:text-gray-900 mb-2">
        <option value="">-- select school --</option>
        @foreach($schools as $school)
        <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach
    </select>
    @if($selectedSchool != null)
    <select wire:model="selectedSpec" class="rounded font-semibold text-base text-gray-900 dark:text-gray-900 mb-2">
        <option value="">-- select specialization --</option>
        @foreach($specializations as $spec)
        <option value="{{ $spec->id }}">{{ $spec->name }}</option>
        @endforeach
    </select>
    @endif
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Award Name</th>
                <th class="px-4 py-3">Award Type</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
        <tbody class="bg-white">
            @foreach($awards as $award)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-xl font-bold border">{{ $award->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $award->type }}</td>
                <td class="px-4 py-3 text-md border">{{ $award->specialization->name }} ({{ $award->school->name }})</td>

                <td class="px-4 py-3 text-md border">
                    @if($award->awardRubric()->exists())
                        <span class="text-green-500">rubric is set</span>
                    @else
                        <span class="text-red-500">empty</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="selectAward({{ $award->id }})" class="inline-block my-1 rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Set Rubric</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1 bg-white rounded">
            {{ $awards->links() }}
        </div>
    </div>
    {{-- AWARD TABLE --}}

    {{-- SET RUBRIC MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="setRubricModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                @livewire('set-rubric-form')
            </div>
        </div>
    </div>
    {{-- SET RUBRIC MODAL --}}
</div>
