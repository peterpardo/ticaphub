<div>
    <section class="container my-14 max-w-4xl p-6 mx-auto bg-white rounded-md shadow-lg dark:bg-gray-800">
        <h2 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white text-center">{{ $group->name }}</h2>
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white text-center">Student Choice Award</h2>

        @if(session('status'))
            <div class="bg-{{ session('status') }}-500 text-center py-5 my-3 rounded text-white">{{ session('message') }}</div>
        @endif

        <form 
            wire:submit.prevent='confirmVote'
            class="container mx-auto">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Full Name</label>
                    <input wire:model="name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" placholder="Enter your full name">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Email</label>
                    <input wire:model="email" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" placeholder="Enter your email address">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <a href="/specializations/{{ $group->id }}/groups" class="inline-block rounded hover:bg-gray-200 px-4 py-1 shadow mr-4">Back</a>
                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-700 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Submit</button>
            </div>
        </form>
    </section>
</div>
