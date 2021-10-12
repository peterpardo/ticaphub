<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    @if(!$ticap->evaluation_finished)
        <div class="text-right">
            <button id="openModal" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1">Finalize Evaluation</button>
        </div>
    @else
        <div class="flex justify-end my-2">
            <a href="/generate-awards" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mr-1">Generate Awardee Report</a>
            <a href="/generate-panelists" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mr-1">Download List of Panelists</a>
            <a href="/generate-rubrics" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mr-1">Download Graded Rubrics</a>
            <a href="/generate-certificates" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1">Generate Certificates</a>
        </div>
    @endif
    <h1 class="font-semibold mb-2 text-2xl text-center">Individual Award Winners</h1>
    @if(session('status'))
        <div class="bg-{{ session('status') }}-200 text-center rounded py-5 my-2">{{ session('message') }}</div>
    @endif
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        <table class="table-fixed w-full mb-3">
            <thead>
                <tr>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Award</td>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Awardee</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($spec->awards->where('type', 'individual') as $award)
                    @foreach($award->individualWinners as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                        @if(($winner->name != null && $ticap->evaluation_finished) || $award->name == 'Best Project Adviser')
                            <td class="border text-md px-2 py-1">{{ $winner->name }}</td>
                        @elseif($spec->panelists()->where('has_chosen_user', 0)->exists())
                            <td class="border text-md px-2 py-1"><span class="text-red-500">panelists still choosing</span></td>
                        @else
                            <td class="border text-md px-2 py-1"><span class="text-green-500">done choosing</span></td>
                        @endif
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach

    <h1 class="text-center font-semibold text-2xl mb-2">Group Award Winners</h1>
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        <table class="table-fixed w-full mb-3">
            <thead>
                <tr>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Award</td>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($spec->awards->where('type', 'group') as $award)
                    @foreach($award->groupWinners as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach

    
    <h1 class="text-center font-semibold text-2xl mb-2">Student Choice Award Winners</h1>
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        <table class="table-fixed w-full mb-3">
            <thead>
                <tr>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Specialization</td>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                </tr>
            </thead>
            <tbody>
                @foreach($spec->studentChoiceAwards as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $spec->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    {{-- FINALIZE EVALUATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="finalizeModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
             <!--content-->
             <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to submit the evaluation? This process cannot be undone.</p>
                </div>
                <!--footer-->
                <form action="{{ route('review-results') }}" method="post">
                    @csrf
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <button id="closeModal" class="inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- FINALIZE EVALUATION MODAL --}}
</x-app-layout>