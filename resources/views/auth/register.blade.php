<x-guest-layout>

    <x-auth-card>
    
        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        {{-- <form method="POST" action="/register">
            @csrf

            <!-- Register Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form> --}}



        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">

            <h1 class="font-bold text-center text-2xl mb-5">TICaP Hub</h1>  

            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 p-4" :errors="$errors" />

                <form 
                    method="POST" 
                    action="{{ route('register') }}">
                    @csrf

                    <!-- HIDDEN VALUES -->
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="ticap" value="{{ $ticap }}">

                    <div class="px-5 py-7">

                        

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
                        

                        <div class="col-span-6 sm:col-span-4 mb-5">
                            <label class="block text-sm font-semibold text-gray-700">School</label>
                            <select id="school" name="school" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" @change="changeCategory">
                              <option value="">-- select school --</option>

                              @foreach(App\Models\School::all() as $school)
                              <option value="{{ $school->id }}">{{ $school->name }}</option>
                              @endforeach

                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-4 mb-5">
                            <label class="block text-sm font-semibold text-gray-700">Specialization</label>
                            <select id="specialization" name="specialization" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" @change="changeCategory">
                              <option value="">-- select specialization --</option>

                              @foreach(App\Models\Specialization::all() as $specialization)
                              <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                              @endforeach

                            </select>
                        </div>

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                        <input type="email" name="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="old('email')" required />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Student Number</label>
                        <input type="number" name="student_number" value="{{ old('student_number') }}" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                        <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="__('Password')" required/>

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="__('Confirm Password')" required/>

                        <button type="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Register</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>

                    </div>

                </form>

            </div>

        </div>




    </x-auth-card>
</x-guest-layout>
