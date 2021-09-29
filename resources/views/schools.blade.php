<x-guest-layout>
    <div class="container mx-auto w-8/12">

        <h1 class="text-center text-5xl my-5 font-black">Schools</h1>
        
        <div class="grid grid-cols-1 gap-x-12 gap-y-4 md:grid-cols-2 w-auto md:w-9/12 mx-auto">

            <a href="{{ route ('specialization') }}">
            <div class="w-auto bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                <div class="overflow-x-hidden rounded-2xl relative">
                  <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="https://images.unsplash.com/photo-1632871975364-e6d471ece9e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=465&q=80">                  
                </div>
                <div class="mt-4 pl-2 mb-2 flex justify-center ">
                  <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">FEU TECH</h1>
                  </div>
                </div>
              </div> 
              <a href="{{ route ('specialization') }}">
            <div class="w-auto bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                <div class="overflow-x-hidden rounded-2xl relative">
                  <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="https://images.unsplash.com/photo-1632871975364-e6d471ece9e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=465&q=80}">                  
                </div>
                <div class="mt-4 pl-2 mb-2 flex justify-center ">
                  <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">FEU ALABANG</h1>
                  </div>
                </div>
              </div>

              <a href="{{ route ('specialization') }}">
            <div class="w-auto bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                <div class="overflow-x-hidden rounded-2xl relative">
                  <img class="h-40 hover:opacity-75 rounded-2xl w-full object-cover" src="https://images.unsplash.com/photo-1632871975364-e6d471ece9e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=465&q=80">                  
                </div>
                <div class="mt-4 pl-2 mb-2 flex justify-center ">
                  <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">FEU DILIMAN</h1>
                  </div>
                </div>
              </div>
            </a>
        </div>
    </div>
</x-guest-layout>

{{-- BACKUP --}}
       {{-- <div class="cursor-pointer h-5/6 w-5/6 my-5 max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="px-4 py-2 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 uppercase dark:text-white">ITSMBA</h1>
                </div>

                <img class="object-cover w-full h-48 mt-2 hover:opacity-75" src="{{ asset('assets/SMBA.png') }}">
            </div> --}}