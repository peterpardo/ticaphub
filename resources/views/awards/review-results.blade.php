<x-app-layout :scripts="$scripts">
    <div x-data="{
        openWinnerModal: false,
        openRecognitionModal: false,
        openPanelistModal: false,
        openCertificateModal: false,
        openGroupCertificateModal: false,
        openStudentChoiceCertificateModal: false,
        winner: '',
        isOpen: false
    }">
        <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
        @if(!$ticap->evaluation_finished)
        <div class="text-right">
            <button id="openModal" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1">Finalize Evaluation</button>
        </div>
        @else
            <div class="flex justify-end">
                <div class="inline-block">
                    <!-- Dropdown toggle button -->
                    <button @click.prevent="isOpen = !isOpen" @click.away="isOpen = false" class="flex items-center z-10 p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                        <span class="mx-1">Actions</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="isOpen" class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                        <button @click.prevent="openWinnerModal = true" class="flex items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>

                            <span class="mx-1">
                                Email Certificates of Winners
                            </span>
                        </button>

                        <button @click.prevent="openRecognitionModal = true" class="flex items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>

                            <span class="mx-1">
                                Email Certificates of Recognition
                            </span>
                        </button>

                        <button @click.prevent="openPanelistModal = true" class="flex items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>

                            <span class="mx-1">
                                Email Certificates of Panelists
                            </span>
                        </button>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <a href="/generate-awards" class="flex items-center px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>

                            <span class="mx-1">
                                Download List of Awardees
                            </span>
                        </a>

                        <a href="/generate-panelists" class="flex items-center px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>

                            <span class="mx-1">
                                Download List of Panelists
                            </span>
                        </a>

                        <a href="/generate-graded-rubrics" class="flex items-center px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>

                            <span class="mx-1">
                                Download Group Grades
                            </span>
                        </a>

                        <a href="/generate-certificates" class="flex items-center px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>

                            <span class="mx-1">
                                Generate Certificates
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <h1 class="font-semibold mb-2 text-2xl text-center">Individual Award Winners</h1>
        @if(session('status'))
        <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4" role="alert">
            <p class="font-bold">{{ session('message') }}</p>
          </div>
        @endif
        @foreach($specs as $spec)
            <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
            <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
            <table class="table-fixed w-full">
                <thead>
                    <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                        <td class="px-4 text-md font-semibold border">Award</td>
                        <td class="px-4 text-md font-semibold border">Group</td>
                        <td class="px-4 text-md font-semibold border">Awardee</td>
                        @if($ticap->evaluation_finished)
                            <td class="px-4 text-md font-semibold border">Certificate</td>
                        @endif
                    </tr>
                </thead>
                <tbody class="w-auto bg-white text-center text-gray-800">
                    @foreach ($spec->awards->where('type', 'individual') as $award)
                        @foreach($award->individualWinners as $winner)
                        <tr>
                            <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                            <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                            @if(($winner->name != null && $ticap->evaluation_finished) || $award->name == 'Best Project Adviser')
                                <td class="border text-md px-2 py-1">{{ $winner->name }}</td>
                                @if($ticap->evaluation_finished)
                                    <td class="border text-md px-2 py-1">
                                        <button @click.prevent="openCertificateModal = true; winner = {{ $winner->id }}"  class="flex items-center mx-auto bg-blue-500 rounded text-white px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="inline-block ml-1">Email Certificate</span>
                                        </button>
                                    </td>
                                @endif
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
                </div>
            </div>
        @endforeach

        <h1 class="text-center font-semibold text-2xl mb-2">Group Award Winners</h1>
        @foreach($specs as $spec)
            <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
            <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                                <td class="px-4 text-md font-semibold border">Award</td>
                                <td class="px-4 text-md font-semibold border">Group</td>
                                @if($ticap->evaluation_finished)
                                    <td class="px-4 text-md font-semibold border">Certificate</td>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="w-auto bg-white text-center text-gray-800">
                            @foreach ($spec->awards->where('type', 'group') as $award)
                                @foreach($award->groupWinners as $winner)
                                <tr>
                                    <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                                    @if($ticap->evaluation_finished)
                                        <td class="border text-md px-2 py-1">
                                            <button @click.prevent="openGroupCertificateModal = true; winner = {{ $winner->group->id }}"  class="flex items-center mx-auto bg-blue-500 rounded text-white px-2 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="inline-block ml-1">Email Certificate</span>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <h1 class="text-center font-semibold text-2xl mb-2">Student Choice Award Winners</h1>
        @foreach($specs as $spec)
            <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
            <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                                <td class="px-4 text-md font-semibold border">Specialization</td>
                                <td class="px-4 text-md font-semibold border">Group</td>
                                @if($ticap->evaluation_finished)
                                    <td class="px-4 text-md font-semibold border">Certificate</td>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="w-auto bg-white text-center text-gray-800">
                            @foreach($spec->studentChoiceAwards as $winner)
                                <tr>
                                    <td class="border text-md px-2 py-1">{{ $spec->name }}</td>
                                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                                    @if($ticap->evaluation_finished)
                                        <td class="border text-md px-2 py-1">
                                            <button @click.prevent="openStudentChoiceCertificateModal = true; winner = {{ $winner->id }}"  class="flex items-center mx-auto bg-blue-500 rounded text-white px-2 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="inline-block ml-1">Email Certificate</span>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

        {{-- EMAIL CERTIFICATES OF WINNERS MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openWinnerModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-winner-awards"
                        method="post"
                    >
                        @csrf
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Certificates of Winners</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificates to the participants of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openWinnerModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL CERTIFICATES OF WINNERS MODAL --}}

        {{-- EMAIL CERTIFICATE OF RECOGNITION MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openRecognitionModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-recognition"
                        method="post"
                    >
                        @csrf
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Certificate of Recognition</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificates to the participants of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openRecognitionModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL CERTIFICATE OF RECOGNITION MODAL --}}

        {{-- EMAIL CERTIFICATE OF PANELISTS MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openPanelistModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-panelists"
                        method="post"
                    >
                        @csrf
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Certificate Of Panelists</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificates to the participants of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openPanelistModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL CERTIFICATE OF PANELISTS MODAL --}}

        {{-- EMAIL INDIVIDUAL CERTIFICATE MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openCertificateModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-single-certificate/"
                        method="post"
                    >
                    @csrf
                        {{-- winner id --}}
                        <input type="hidden" name="winner" x-model="winner">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Individual Award Certificate</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificate to the participant of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openCertificateModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL INDIVIDUAL CERTIFICATE MODAL --}}

        {{-- EMAIL GROUP CERTIFICATE MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openGroupCertificateModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-group-certificate"
                        method="post"
                    >
                    @csrf
                        {{-- winner id --}}
                        <input type="hidden" name="winner" x-model="winner">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Group Award Certificate</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificate to the participant of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openGroupCertificateModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL GROUP CERTIFICATE MODAL --}}

        {{-- EMAIL STUDENT CHOICE CERTIFICATE MODAL --}}
        <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-show="openStudentChoiceCertificateModal">
            <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div >
                    <form
                        action="/email-student-choice-certificate/"
                        method="post"
                    >
                    @csrf
                        {{-- winner id --}}
                        <input type="hidden" name="winner" x-model="winner">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <h2 class="text-xl font-bold py-4 text-gray-800">Email Student Choice Certificate</h3>
                                <p class="text-sm text-gray-500 px-8 mb-2">Do you want to send the certificate to the participant of the TICaP Event? This process can't be undone.</p>
                            </div>
                            <!--footer-->
                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button @click.prevent="openStudentChoiceCertificateModal = false" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                                <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Email</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        {{-- EMAIL STUDENT CHOICE CERTIFICATE MODAL --}}
    </div>
</x-app-layout>
