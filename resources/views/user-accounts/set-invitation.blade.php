<x-app-layout title="User Accounts" class="w-full mx-auto" style="max-width: 900px"
    x-data="sample">
    {{-- <livewire:school-table /> --}}

    {{-- Schools --}}
    <h1 class="inline-block text-lg font-bold">Schools</h1>
    <span class="inline-block px-2 py-.5 bg-gray-100 rounded text-sm text-gray-500">Toggle the button beside the school</span>
    <div class="flex flex-col mt-2 w-full space-y-2 text-sm sm:flex-row sm:space-y-0">
        <template x-for="school in schools" :key="school.id">
            <template x-if="school.id !== 1">
                <div class="flex items-center mr-4">
                    <h1 class="w-28" x-text="school.name"></h1>
                    <button
                        @click.prevent="
                            school.is_involved = !school.is_involved;
                            updateSchoolStatus(school.id);
                        "
                        :class="school.is_involved ? 'px-2 py-1 bg-green-100 text-green-400 rounded hover:bg-green-200' : 'px-2 py-1 bg-red-100 text-red-400 rounded hover:bg-red-200'">
                        <span x-show="school.is_involved">included</span>
                        <span x-show="!school.is_involved">excluded</span>
                    </button>
                </div>
            </template>
        </template>
    </div>

    <hr class="w-full h-0.5 bg-gray-500 my-5">

    {{-- Specializations --}}
    <h1 class="text-lg font-bold">Specializations</h1>

    {{-- <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-center">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      School
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Specialization
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Action
                    </th>
                  </tr>
                </thead class="border-b">
                <tbody id="specTable"></tbody>
              </table>
            </div>
          </div>
        </div>
    </div> --}}

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-center">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      School
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Specialization
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Action
                    </th>
                  </tr>
                </thead class="border-b">
                {{-- Specialization Content --}}
                <tbody>
                    <template x-for="school in schools" :key="school.id">
                        <template x-for="spec in school.specializations" :key="spec.id">
                            <tr>
                                <td x-text="school.name" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"></td>
                                <td x-text="spec.name" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"></td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <button class="bg-red-500 hover:bg-red-700 text-white rounded p-1">&times;</button>
                                </td>
                            </tr>
                        </template>
                    </template>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    {{-- Scripts --}}
    @push('scripts')
        <script src="{{ asset('js/users/set-invitation.js') }}"></script>
    @endpush
</x-app-layout>
