<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="font-bold text-4xl mb-2 text-center">{{ $ticap }}</h1>
    <h1 class="text-center text-2xl mb-3">Election of Officers</h1>
    <h1 class="text-center text-xl mb-3">{{ $election->name }}</h1>
    <form 
        action="{{ route('vote') }}" 
        method="post"
        id="voteForm">
        @csrf
        @foreach($positions as $position) 
        <div class="mb-3 w-1/5 mx-auto text-center">
            @error($position->name)
            <div class="text-center text-red-500">{{ $message }}</div>
            @enderror
            <div class="font-semibold text-xl border-b-2 border-gray-500 px-3 mb-2">{{ $position->name }}</div>
            <table class="mb-2 mx-auto">
                @foreach($election->officers as $officer) 
                    @if($officer->position_id == $position->id)
                    <tr>
                        @if ($officer->is_elected)
                        <td class="py-2 px-2">
                            {{ $officer->user->last_name . ', ' .  $officer->user->first_name . ' ' . $officer->user->middle_name }}
                        </td>
                        @else
                        <td class="py-2 px-2">
                            <input type="radio" name="{{ $position->name }}" id="{{ $officer->user->id }}" value="{{ $officer->user->candidate->id }}">
                        </td>
                        <td class="py-2 px-2">
                            <label for="{{ $officer->user->id  }}">{{ $officer->user->last_name . ', ' .  $officer->user->first_name . ' ' . $officer->user->middle_name }}</label>
                        </td>
                        @endif
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
        @endforeach
        <div class="text-center">
            <button type="submit" id="openConfModal" class="inline-block cursor-pointer bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Submit Vote</butt>
        </div>
    </form>
   
    {{-- CONFIRMATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-5">Do you want to submit your votes? You will not be able to change it once you proceed.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <a  id="closeConfModal" class="inline-block cursor-pointer mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                    <a id="submitVote" class="inline-block cursor-pointer mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}
</x-app-layout>