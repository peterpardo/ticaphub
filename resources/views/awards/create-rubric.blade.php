<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="text-center font-semibold text-4xl mb-5">Create Rubric</h1>
    <form 
        action="{{ route('rubric') }}" 
        method="post"
        id="rubricForm">
        @csrf
        <div class="w-1/2 mx-auto shadow px-2 py-5 bg-white text-gray-800 rounded">
            <div class="mb-5">
                <label class="font-semibold mr-3">Rubric Name</label>
                <input type="text" name="name" id="name" class="text-gray-800 rounded">
                <div id="nameError" class="my-2"></div>
            </div>

            <div id="criteriaList">   
                <div class="flex flex-col mx-auto mb-2 text-gray-800">  
                    <h1 class="font-semibold mb-2">Criteria</h1>
                    <div class="flex">
                        <input type="text" name="criteria[]" id="criteria" class="flex-1 rounded mr-3" placeholder="Criteria name">
                        <input type="number" name="percentages[]" id="percentages" class="flex-1 rounded" placeholder="Criteria percentage">
                    </div>
                </div>
            </div>
            <a id="addCriteriaBtn" class="inline-block cursor-pointer bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1 mb-4">Add Criteria</a>
            <div id="criteriaError" class="text-center mb-2"></div>
            <div id="percError" class="text-center mb-2"></div>
            <div class='text-center mt-4'>
                <a href="/set-rubrics" class="text-gray-800  inline-block cursor-pointer shadow border bg-gray-50 hover:bg-gray-200 rounded px-2 py-1 mr-3">Cancel</a>
                <button type="submit" class="inline-block cursor-pointer bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>