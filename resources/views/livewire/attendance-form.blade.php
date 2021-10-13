<div>
    <section class="container my-14 max-w-4xl p-6 mx-auto bg-white rounded-md shadow-lg dark:bg-gray-800">
        <h2 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white text-center">{{ $event->name }}</h2>
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white text-center">Attendance</h2>
        
        <form 
            wire:submit.prevent='confirmAttendance'
            class="container mx-auto">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200">First Name</label>
                    <input wire:model="fname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('fname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Middle Name</label>
                    <input wire:model="mname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('mname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Last Name</label>
                    <input wire:model="lname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('lname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Email</label>
                    <input wire:model="email" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Course</label>
                    <select wire:model="selectedSpec" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <option name="" id="">--- select specialization ---</option>
                        @foreach ($specs as $spec)
                            <option value="{{ $spec->id }}">({{ $spec->school->name }}) {{ $spec->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedSpec')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
              
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-700 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Submit</button>
            </div>
        </form>
    </section>
</div>
