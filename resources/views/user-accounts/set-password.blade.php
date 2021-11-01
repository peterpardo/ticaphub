<x-guest-layout>
    <x-auth-card>
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <h1 class="font-bold text-center text-2xl mb-5">TICaP Hub</h1>  
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                @if($isInvited)
                    <form 
                        method="POST" 
                        action="{{ route('set-password') }}">
                        @csrf
                        <!-- HIDDEN VALUES -->
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="ticap" value="{{ $ticap }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="px-5 py-7">
                            <h1 class="font-semibold">Welcome, {{ $email }}</h1>
                            <h1 class="my-2 text-center">Set Password</h1>
                            @if(session('error'))
                            <div class="text-red-500">{{ session('error') }}</div>
                            @endif
                            @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                            <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="__('Password')" required/>
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" :value="__('Confirm Password')" required/>
                            <button type="submit" class="transition duration-200 bg-red-500 hover:bg-red-600 focus:bg-red-700 focus:shadow-sm focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                <span class="inline-block mr-2">Submit</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-center font-semibold py-5 px-4">Email not registered in the system. Contact the admin for more details.</p>
                @endif
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>