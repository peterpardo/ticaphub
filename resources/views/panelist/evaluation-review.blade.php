<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="text-3xl mb-1 text-center font-semibold">{{ $ticap->name }}</h1>
    <h1 class="text-xl mb-1 text-center font-semibold">{{ $user->specializationPanelist->specialization->school->name }}</h1>
    <h1 class="text-xl mb-1 text-center font-semibold">{{ $user->specializationPanelist->specialization->name }}</h1>
    <div class="flex justify-between">
        <a href="{{ route('change-grades') }}" class="inline-block my-2 bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1">Change Grades</a>
        <button id="openModal" class="inline-block my-2 bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1">Submit Evaluation</button>
    </div>
    <h1 class="text-lg mb-1 font-semibold">Review Grades</h1>

    @foreach($user->specializationPanelist->specialization->awards as $award)
        <h1 class="text-lg text-center font-semibold my-1">{{ $award->name }}</h1>
        <table class="w-full mb-4">
            <thead>
                <tr>
                    <td class="px-2 py-2 bg-gray-100 text-lg border"></td>
                    @foreach($user->specializationPanelist->specialization->groups as $group)
                    <td class="px-2 py-2 bg-gray-100 text-lg border">{{ $group->name }}</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($award->awardRubric->rubric->criteria as $crit)
                    <tr>
                        <td class="px-2 py-2 text-lg border">{{ $crit->name }}</td>
                        @foreach($user->specializationPanelist->specialization->groups as $group)
                            <td class="px-2 py-2 text-lg border">{{ $group->groupGrades->where('criteria_id', $crit->id)->where('award_id', $award->id)->pluck('grade')->first() }}</td>
                        @endforeach
                    </tr>
                @endforeach
                    <tr>
                        <td class="px-2 py-2 text-lg border font-bold bg-gray-100">Total</td>
                        @foreach($user->specializationPanelist->specialization->groups as $group)
                            <td class="px-2 py-2 text-lg border font-bold bg-gray-100">{{  $group->panelistGrades->where('award_id', $award->id)->pluck('total_grade')->first() }}</td>
                        @endforeach
                    </tr>
            </tbody>
        </table>
    @endforeach

     {{-- SUBMIT MODAL --}}
     <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmGradesModal">
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
                <form action="{{ route('review-grades') }}" method="post">
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