<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>

        <h1 class="font-bold text-3xl text-center mb-3">Manage Election</h1>

        <div class="text-center">
            <h1 class="font-semibold text-xl">{{ $ticap }}</h1>
        </div>
                
        <section class="container p-6">

            <h1 class="font-bold text-xl mb-2">Position</h1>
            <a class="inline-block cursor-pointer bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500 mb-5" id="modal-btn">Add Position</a>

            {{-- <div class="w-full mb-3 overflow-hidden rounded-lg shadow-lg">

                <div class="w-full overflow-y-auto"> --}}

                    <table class="rounded-lg shadow-lg">

                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white"></tbody>

                    </table>

                {{-- </div>

            </div> --}}

        </section>

        <div class="text-center">

            <a class="inline-block bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500 cursor-pointer" href="{{ route('set-candidates') }}">Set Candidates</a>

        </div>
            
    </div>

    {{-- ADD POSITION MODAL OVERLAY --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
    
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <form 
                    action="{{ route('set-positions') }}" 
                    method="POST"
                    id="addPositionForm">
                    @csrf
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">

                        <div id="message"></div>

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Position Name</label>
                        <input type="text" name="position" id="position" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-center" :value="old('position')" required />
                        
                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">

                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        
                        <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Add</button>

                    </div>

                </form>

            </div>

        </div>
        {{-- ADD POSITION MODAL OVERLAY - END LINE --}}

    </div>

</x-app-layout>