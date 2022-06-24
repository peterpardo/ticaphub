<x-app-layout title="User Accounts">
    <div class="w-100 max-w-lg mx-auto" x-data="form">
        {{-- Back button --}}
        <x-app.button type="link" color="red" href="{{ url('users') }}" class="inline-block mb-5">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>


        {{-- Form --}}
        <x-app.form>
            <x-form.title>Import Students</x-form.title>

            {{-- School --}}
            <x-form.form-control>
                <x-form.label for="school">School</x-form.label>
                <x-form.select name="school" id="school" x-model="selectedSchool">
                    <template x-for="school in schools" :key="school.id">
                        <option x-text="school.name" :value="school.id"></option>
                    </template>
                </x-form.select>
            </x-form.form-control>

            {{-- Specialization --}}
            <x-form.form-control>
                <x-form.label for="specialization">Specialization</x-form.label>
                <x-form.select name="specialization" id="specialization" x-model="selectedSpecialization">
                    <option value="" selected>---select specialization---</option>
                    <template x-for="specialization in specializations" :key="specialization.id">
                        <option x-text="specialization.name" :value="specialization.id"></option>
                    </template>
                </x-form.select>
            </x-form.form-control>

            {{-- File --}}
            <x-form.form-control>
                <x-form.label>Upload File</x-form.label>
                <span class="block py-1 px-2 rounded bg-gray-100 text-gray-500 text-xs">
                    <span class="font-bold">Note:</span> Use this <a href="{{ url('download-sample') }}" class="text-blue-700 cursor-pointer font-bold italic hover:text-blue-500 underline">Sample Template</a> in collecting the list of students.
                </span>
                <x-form.input type="file"/>
            </x-form.form-control>

            <div class="text-right">
                <x-app.button color="green">Upload</x-app.button>
            </div>
        </x-app.form>
    </div>

    @push('scripts')
        <script>
             document.addEventListener('alpine:init', () => {
                Alpine.data('form', () => ({
                    async init() {
                        let responses = await Promise.all([fetch('/get-schools'), fetch('/get-specializations/1')]);
                        let data = await Promise.all([responses[0].json(), responses[1].json()])
                        this.schools = data[0];
                        this.specializations = data[1];
                        this.$watch('selectedSchool', (id) => this.updateSpecialization(id));
                    },

                    schools: [],
                    specializations: [],
                    selectedSchool: 1,
                    selectedSpecialization: '',

                    async updateSpecialization(id) {
                        let response = await fetch(`/get-specializations/${id}`)
                        let data = await response.json();
                        this.specializations = data;
                        this.selectedSpecialization = '';;
                    },

                    toggle() {
                        this.open = ! this.open
                    }
                }))
            })
        </script>
    @endpush
</x-app-layout>
