<x-app-layout title="User Accounts">
    <div x-data="importStudents" class="space-y-5 w-full max-w-screen-sm mx-auto">
        <x-app.button type="link" color="red" href="{{ url('users') }}" >
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>

        {{-- Alert --}}
        @if (session('status'))
            <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
        @endif

        <h1 class="text-2xl font-bold pb-2 border-b-2 border-gray-300">Import Students</h1>

        {{-- Form --}}
        <x-form method="POST" action="{{ route('import-students') }}" enctype="multipart/form-data">
            @csrf
            {{-- School --}}
            <x-form.form-control>
                <x-form.label for="school">School</x-form.label>
                <x-form.select name="school" id="school" x-model="selectedSchool">
                    <template x-for="school in schools" :key="school.id">
                        <option x-text="school.name" :value="school.id"></option>
                    </template>
                </x-form.select>
                @error('school')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            {{-- Specialization --}}
            <x-form.form-control>
                <x-form.label>Specialization</x-form.label>
                <x-form.select name="specialization" id="specialization" x-model="selectedSpecialization">
                    <option value="">---select specialization</option>
                    <template x-for="specialization in specializations" :key="specialization.id">
                        <option x-text="specialization.name" :value="specialization.id"></option>
                    </template>
                </x-form.select>
                @error('specialization')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            {{-- File --}}
            <x-form.form-control>
                <x-form.label>Upload File</x-form.label>
                <x-form.input-info>
                    <strong>Note:</strong>
                    Download this <a href="{{ url('/download-sample') }}" class="text-blue-700 underline italic hover:text-blue-500">template</a> as the guide for listing all of the students involved in this TICAP event. Upload only the <strong>.csv</strong> format of the template file.
                </x-form.input-info>
                <x-form.input type="file" name="file" accept=".csv"/>
                @error('file')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>


            <div class="text-right">
                <x-app.button type="submit" color="green">Upload File</x-app.button>
            </div>
        </x-form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('importStudents', () => ({
                    async init() {
                        let responses = await Promise.all([fetch('/get-schools'), fetch(`/get-specializations/${this.selectedSchool}`)]);
                        let data = await Promise.all([responses[0].json(), responses[1].json()]);
                        this.schools = data[0];
                        this.specializations = data[1];

                        this.selectedSchool = "{{ old('school') }}" === '' ? 1 : parseInt("{{ old('school') }}");
                        // this.selectedSpecialization = "{{ old('specialization') }}" === '' ? '' : parseInt("{{ old('specialization') }}");
                        this.selectedSpecialization = 13;

                        // Watch for change in value of the school
                        this.$watch('selectedSchool', async (value) => {
                            let response = await fetch(`/get-specializations/${value}`);
                            let data = await response.json();
                            this.specializations = data;
                            this.selectedSpecialization = '';
                        });
                    },

                    schools: [],
                    selectedSchool: "{{ old('school') }}" === '' ? 1 : "{{ old('school') }}",
                    specializations: [],
                    selectedSpecialization: '',
                }))
            })
        </script>
    @endpush
</x-app-layout>
