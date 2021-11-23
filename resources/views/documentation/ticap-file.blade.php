<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex flex-wrap overflow-hidden">
        <div class="flex-1 mx-1 px-2 py-1 shadow rounded bg-white text-gray-800">
            <h1 class="font-semibold text-2xl my-2">Events</h1>
            <div class="divide-y-2">
                @if($ticap->archivedEvents->count() == 0)
                    <div class="text-center bg-gray-100 rounded py-5 my-1">No Events</div>
                @else
                    @foreach ($ticap->archivedEvents as $event)
                    <div class="mb-2">
                        <h1 class="text-lg font-semibold my-2">{{ $event->name }}</h1>
                        <div class="mb-2">
                            <p class="mb-1">Program flow/s</p>
                            @if($event->archivedPrograms->count() == 0)
                                <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                    <p class="font-bold">No program flows</p>
                                  </div>
                            @else
                                <ul class="list-disc list-inside">
                                    @foreach($event->archivedPrograms as $program)
                                    <li>
                                        <a href="/{{ $program->path }}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">{{ $program->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="mb-2 ">
                            <p class="mb-1">Files</p>
                            @if($event->archivedFiles()->count() == 0)
                                <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                    <p class="font-bold">No files uploaded</p>
                                  </div>
                            @else
                            <ul class="list-inside list-disc">
                                @foreach ($event->archivedFiles as $file)
                                <li>
                                    <a href="/event-files/{{ $file->path }}" class="text-blue-500 hover:text-blue-600 underline">{{ $file->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="mt-5 sm:mt-0 flex-1 mx-1 px-2 py-1 shadow rounded bg-white text-gray-800">
            <h1 class="font-semibold text-2xl mt-2">Files</h1>
            <div class="flex justify-center">
            <div class="bg-white w-11/12 mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                <table class="w-auto table-auto">
                    <thead>
                    <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                        <td class=" border px-3 py-2 font-semibold">Name</td>
                        <td class=" border px-3 py-2 font-semibold">File Name</td>
                        <td class=" border px-3 py-2 font-semibold">Download</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-3 py-2">Officers</td>
                        @if($ticap->archivedOfficers()->count() == 0)
                            <td class="border px-3 py-2">No Officers in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedOfficers->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedOfficers->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Capstone Groups</td>
                        @if($ticap->archivedGroups()->count() == 0)
                            <td class="border px-3 py-2">No Groups in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedGroups->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedGroups->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Winner Certificates</td>
                        @if($ticap->archivedWinnerCertificates()->count() == 0)
                            <td class="border px-3 py-2">No Certificates in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedWinnerCertificates->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedWinnerCertificates->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Recognition Certificates</td>
                        @if($ticap->archivedRecognitionCertificates()->count() == 0)
                            <td class="border px-3 py-2">No Certificates in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedRecognitionCertificates->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedRecognitionCertificates->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Panelist Certificates</td>
                        @if($ticap->archivedPanelistCertificates()->count() == 0)
                            <td class="border px-3 py-2">No Certificates in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedPanelistCertificates->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedPanelistCertificates->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Awardees</td>
                        @if($ticap->archivedAwardees()->count() == 0)
                            <td class="border px-3 py-2">No Awardees in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedAwardees->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedAwardees->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Rubrics</td>
                        @if($ticap->archivedRubrics()->count() == 0)
                            <td class="border px-3 py-2">No Rubrics in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedRubrics->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedRubrics->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Graded Rubrics</td>
                        @if($ticap->archivedGradedRubrics()->count() == 0)
                            <td class="border px-3 py-2">No Graded Rubrics in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedGradedRubrics->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedGradedRubrics->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>

                    <tr>
                        <td class="border px-3 py-2">Panelists</td>
                        @if($ticap->archivedPanelists()->count() == 0)
                            <td class="border px-3 py-2">No Panelists in this TICaP</td>
                            <td class="border px-3 py-2">
                                <span class="inline-block rounded px-2 py-1 border shadow">Unavailable</span>
                            </td>
                        @else
                            <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedPanelists->name }}.pdf</td>
                            <td class="border px-3 py-2">
                                <a href="{{ Storage::url($ticap->archivedPanelists->path) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        <span class="inline-block">Download</span>
                                    </div>
                                </a>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

            <h1 class="font-semibold text-2xl my-2">Capstone Group Files</h1>
            @if($ticap->archivedExhibits->count() == 0) 
                <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                    <p class="font-bold">No files uploaded</p>
                                  </div>
            @else
                @foreach($ticap->archivedExhibits as $exhibit)
                    <div>{{ $exhibit->name }}</div>
                    @if($exhibit->files()->count() == 0)
                        <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                    <p class="font-bold">No files uploaded</p>
                                  </div>
                    @else
                    <ul class="list-inside list-disc">
                        @foreach ($exhibit->files as $file)
                        <li>
                            <a href="{{ Storage::url($file->path) }}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">{{ $file->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                @endforeach
            @endif
           
        </div>
    </div>
</x-app-layout>