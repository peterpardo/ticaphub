<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex justify-between">
        <a href="/generate-rubrics" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 rounded text-white">Download Rubrics</a>
        <button id="openModal" class="inline-block bg-green-500 hover:bg-green-600 px-2 py-1 rounded text-white">Generate Results</button>
    </div>

    @if(session('error'))
        <div class="bg-red-500 py-3 text-center text-white rounded my-1">{{ session('error') }}</div>
    @endif
    
    <h1 class="font-bold text-xl my-3 text-center">List of Panelists</h1>
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Specialization</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Panelists</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($panelists as $panelist)
                <tr>
                    <td class="px-2 py-2 text-mdg border">{{ $panelist->specialization->name}} ({{ $panelist->specialization->school->name}})</td>
                    <td class="px-2 py-2 text-mdg border">{{ $panelist->user->first_name }} {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}</td>
                    <td class="px-2 py-2 text-mdg border">
                        @if($panelist->is_done)
                            <span class="text-green-500">done</span>
                        @else
                        <span class="text-red-500">evaluating</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1 class="font-bold text-xl my-3 text-center">Student Choice Votes</h1>
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Specialization</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Group</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Votes</td>
            </tr>
        </thead>
        <tbody>
            @foreach($specs as $spec)
                @foreach($spec->groups as $group)
                    <tr>
                        <td class="px-2 py-2 text-mdg border">{{ $spec->name}} ({{ $spec->school->name}})</td>
                        <td class="px-2 py-2 text-mdg border">{{ $group->name }}</td>
                        <td class="px-2 py-2 text-mdg border">{{ \App\Models\StudentChoiceVote::where('group_id', $group->id)->count() }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    {{-- SUBMIT MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="generateResultsModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
             <!--content-->
             <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to generate the results? This process cannot be undone.</p>
                </div>
                <!--footer-->
                <form action="{{ route('assessment-panel') }}" method="post">
                    @csrf
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <button id="closeModal" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- SUBMIT MODAL --}}
</x-app-layout>