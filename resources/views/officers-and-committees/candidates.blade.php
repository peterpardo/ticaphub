<x-app-layout :scripts="$scripts">

    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>

        <h1 class="font-bold text-xl my-3">Candidate</h1>

        @if(Session::get('error'))
            <div class="text-red-500">{{ Session::get('error')  }}</div>
        @endif

        <a class="inline-block cursor-pointer bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500 mb-5" id="modal-btn">Add Candidate</a>
        
        <div class="flex flex-col flex-nowrap lg:flex-row lg:flex-wrap w-full mb-5">
            
            {{-- CANDIDATES  - START --}}
            <table class="w-full rounded-lg shadow-lg mx-1 text-center">

                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Position</th>
                        <th class="px-4 py-3">Student Name</th>
                        <th class="px-4 py-3">Student Number</th>
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Specialization</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white" id="positions"></tbody>
                
            </table>
            {{-- CANDIDATES FOR POSITIONS - END --}}

        </div>

        <div class="text-center">

            <a href="{{ route('election') }}" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Start Election</a>

        </div>

    </div>

    {{-- ADD POSITION MODAL OVERLAY - START --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
    
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <form id="addCandidateForm"
                    >
                    @csrf
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center relative">

                        <div id="errorDiv" class="text-red-500"></div>

                        <input type="hidden" name="student_name" class="user_id"/>

                        <div class="col-span-6 sm:col-span-4 mb-5">
                            <label for="">School</label>
                            <select id="school" name="school" class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" @change="changeCategory">

                            @foreach(\App\Models\School::all() as $school)
                                @if($school->is_involved)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endif
                            @endforeach

                            </select>
                        </div>

                        <div class="relative">
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Student Name</label>
                            <input type="text" name="search" id="search" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-center" required />
                            <div class="absolute w-full top-3/4 rounded bg-white z-40 max-h-40 overflow-auto shadow-sm" id="search_list"></div>
                        </div>
                        

                        <div class="col-span-6 sm:col-span-4 mb-5">
                            <select id="position" name="position" class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" @change="changeCategory">
                              <option value="">-- select position --</option>

                              @foreach(App\Models\Position::all() as $position)
                              <option value="{{ $position->id }}">{{ $position->name }}</option>
                              @endforeach

                            </select>
                        </div>

                        
                        
                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">

                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Add</button>

                    </div>

                </form>

            </div>

        </div>
        {{-- ADD POSITION MODAL OVERLAY - END --}}

</x-app-layout>