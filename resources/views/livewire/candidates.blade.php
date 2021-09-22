<div>
    <div class="container">
            <input type="text" name="search" id="search" placeholder="Search" wire:model="searchCandidate" class="inline-block border rounded-lg px-3 py-2 mt-5 mb-2" required />
	    <div class="row">
	        <div class="col-md-12">
	            <div class="w-full overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="mt-5 text-md text-center font-semibold tracking-wide text-gray-900 uppercase border-b border-gray-600 ">
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
                                
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</td>
                                
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->student_number }}</td>
                                
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $user->school->name ?? '' }}</td>
    
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    @if($user->hasRole('admin'))
                                        None 
                                    @else
                                    {{ $user->userSpecialization->specialization->name ?? ''}}
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
                <div class="mt-5">
	                {{ $users->links() }}
                </div>
	        </div>
	    </div>
	</div>
</div>
