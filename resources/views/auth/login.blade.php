<x-guest-layout>
    <x-auth-card>
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">

            <h1 class="font-bold text-center text-2xl mb-5">Login</h1>

            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">

                <!-- Session Status -->
                <x-auth-session-status class="py-3 text-center" :status="session('status')" :color="session('color')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 p-4" :errors="$errors" />

                <form
                    method="POST"
                    action="{{ route('login') }}">
                    @csrf

                    <div class="px-5 py-7">
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                        <input type="email" name="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="old('email')"  required />

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                        <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="__('Password')" required/>

                        <button type="submit" class="transition duration-200 bg-red-500 hover:bg-red-600 focus:bg-red-700 focus:shadow-sm focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Login</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>

                    </div>

                </form>

                <div class="py-2">

                    <div class="block text-center mt-1">

                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                    </div>

                    <div class="flex justify-center">

                    @if (Route::has('password.request'))
                        <div class="text-center sm:text-left whitespace-nowrap">

                            <a class="inline-block transition duration-200 text-center mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset" href="{{ route('password.request') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                                <span class="inline-block ml-1">Forgot Password</span>
                            </a>

                        </div>
                    @endif

                    </div>

                </div>

            </div>

            <div class="py-5">

                <div class="flex justify-center">

                    <div class="text-center sm:text-left whitespace-nowrap">

                        <a class="inline-block transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset" href="{{ route('home') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span class="inline-block ml-1">Back to Home</span>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </x-auth-card>

</x-guest-layout>
