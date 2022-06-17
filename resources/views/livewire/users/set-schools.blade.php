<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    <div class="bg-yellow-100 py-5 px-6 rounded-lg text-sm text-yellow-600 mb-3">
        <span class="font-bold">Note:</span> You can set the TICAP settings here, which schools are involved, and what specializations are included in each school.
    </div>

    <h1 class="inline-block text-2xl font-bold mr-3">Schools</h1>
    <span class="inline-block px-2 py-.5 bg-gray-100 rounded text-sm text-gray-500">Check the box to include the school</span>

    {{-- Schools --}}
    <div class="flex flex-col w-full space-y-2 my-3">
        @foreach ($schools as $school)
            @if ($school->id !== 1)
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="{{ $school->slug_name  }}" class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                    <label for="{{ $school->slug_name  }}">{{ $school->name }}</label>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Specializations --}}
    <body class="antialiased font-sans bg-gray-200">
        <div class="mx-auto">
            <div class="mb-2">
                <h2 class="inline-block text-2xl font-bold mr-2">Specializations</h2>
                <span class="inline-block px-2 py-.5 bg-gray-100 rounded text-sm text-gray-500">Add specializations for each school</span>
            </div>

            {{-- Specialization Form --}}
            <form wire:submit.prevent="addSpecialization" class="space-y-3 w-full max-w-xs">
                <div class="flex flex-col space-y-1">
                    <label for="selectedSchool" class="text-sm tracking-wide">Select School</label>
                    <select wire:model="selectedSchool" id="selectedSchool" class="w-full py-2 px-3 rounded border border-gray-500 text-sm">
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    {{-- Error message --}}
                    @error('selectedSchool')
                        <span class="text-sm tracking-wide bg-red-100 text-red-500 rounded-lg py-1 px-3">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="name" class="text-sm tracking-wide">Specialization Name (Complete Name)</label>
                    <input type="text" wire:model="name" id="name" class="w-full py-2 px-3 rounded border border-gray-500 text-sm" placeholder="Ex: Web and Mobile Application" autocomplete="off">
                    {{-- Error message --}}
                    @error('name')
                        <span class="text-sm tracking-wide bg-red-100 text-red-500 rounded-lg py-1 px-3">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="p-2 text-sm text-white rounded-lg bg-green-600 hover:bg-green-500">Add Specialization</button>
            </form>

            {{-- Specialization Table --}}
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    School
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Specialization
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specializations as $specialization)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $specialization->school->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $specialization->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Jan 21, 2020
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</div>
