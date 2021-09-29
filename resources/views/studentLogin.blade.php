{{-- <x-guest-layout> --}}
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
    
            <title>{{ config('app.name', 'Laravel') }}</title>
    
            <!-- Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </head>

        <nav class="flex items-center bg-red-800 p-3 justify-center">
            <a href="{{ route ('home') }}" class="p-2 mr-4 inline-flex items-center">
              <img class="w-7 h-7" src="https://scontent.fcrk1-4.fna.fbcdn.net/v/t1.15752-9/242875367_1221841901629666_5837732975797936657_n.png?_nc_cat=104&ccb=1-5&_nc_sid=ae9488&_nc_eui2=AeF8qonOvTOcNpY2cfPzFkvs9fEXyaZenfH18RfJpl6d8WYEeeAgnt76wyZEx-ZEkyPf_wNFQ_AaYTsqxhbX9w8K&_nc_ohc=p_PgkF3v9CsAX-tiz2f&_nc_ht=scontent.fcrk1-4.fna&oh=4cc615dd35648743fb1bd4307b17a9f5&oe=617800CC" alt="">
              <span  class="text-xl text-white font-bold uppercase tracking-wide"
                >TICaP HUB</span>
            </a>
          </nav>

<body class="bg-gray-100">
    <section class="container my-14 max-w-4xl p-6 mx-auto bg-white rounded-md shadow-lg dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Attendance</h2>
        
        <form class="container mx-auto">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="username">First Name</label>
                    <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="emailAddress">Middle Name</label>
                    <input id="" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="password">Last</label>
                    <input id="" type="" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="passwordConfirmation">Email</label>
                    <input id="" type="" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="passwordConfirmation">Course</label>
                    <select id="" type="" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <option name="" id="">BSITWMA</option>
                        <option name="" id="">BSITWMA</option>
                        <option name="" id="">BSITWMA</option>
                    </select>
                    
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="passwordConfirmation">School</label>
                    <select id="" type="" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <option name="" id="">FEU TECH</option>
                        <option name="" id="">FEU DILIMAN</option>
                        <option name="" id="">FEU ALABANG</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-700 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Submit</button>
            </div>
        </form>
    </section>
</body>

{{-- </x-guest-layout> --}}