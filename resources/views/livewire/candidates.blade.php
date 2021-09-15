<div>
    <div class="container">
	    <div class="row">
	        <div class="col-md-12">
                <input type="text" name="search" id="search" placeholder="Search" wire:model="searchCandidate" class="border rounded-lg px-3 py-2" required />
	            <div class="w-full overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Position</th>
                                <th class="px-4 py-3">Student Name</th>
                                <th class="px-4 py-3">Student Number</th>
                                <th class="px-4 py-3">School</th>
                                <th class="px-4 py-3">Specialization</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>   
                        </thead>
                        <tbody class="bg-white">
                        @foreach($users as $user)
                            <tr class="text-gray-700">
                                
                                <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
    
                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        
                                        <div>
                                            <p class="font-semibold text-black">{{ $user->student_number }}</p>
                                            <p class="text-xs text-gray-600">{{ $user->roles->first()->name ?? '' }}</p>
                                        </div>
    
                                    </div>
                                </td>
    
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</td>
                                
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->student_number }}</td>
                                
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->userProgram->school->name ?? '' }}</td>
    
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    @if($user->hasRole('admin'))
                                        None 
                                    @else
                                    {{ $user->userProgram->specialization->name ?? ''}}
                                    @endif
                                </td>
    
                                <td class="px-4 py-3 text-sm border">
                                    <button class="bg-green-400 px-4 py-1 rounded text-white hover:bg-green-500">Add</button>
                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
    
                </div>
	            {{ $users->links() }}
	        </div>
	    </div>
	</div>
</div>
