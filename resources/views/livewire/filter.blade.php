<div>
    <div class="container">
	    <div class="row">
	        <div class="col-md-12">	            
	            <input type="text"  class="form-control" placeholder="Search" wire:model="searchTerm" />
	            <div class="w-full overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">School</th>
                                <th class="px-4 py-3">Specialization</th>
                                <th class="px-4 py-3">Email</th>
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
    
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->userProgram->school->name ?? '' }}</td>
    
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    @if($user->hasRole('admin'))
                                        None 
                                    @else
                                    {{ $user->userProgram->specialization->name ?? ''}}
                                    @endif
                                </td>
    
                                <td class="px-4 py-3 text-xs border">
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">{{ $user->email }}</span>
                                </td>
    
                                <td class="px-4 py-3 text-sm border">
                                    <button class="bg-green-400 px-4 py-1 rounded text-white hover:bg-green-500">View</button>
                                    <button class="bg-yellow-400 px-4 py-1 rounded text-white hover:bg-yellow-500">Edit</button>
                                    <button class="bg-red-400 px-4 py-1 rounded text-white hover:bg-red-500">Delete</button>
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
