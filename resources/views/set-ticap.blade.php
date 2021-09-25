<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Ticap Title</title>
</head>
<section class="">
    <div class="flex h-screen justify-center items-center">
                <form 
                class="text-center bg-white rounded shadow px-6 py-6 m-auto"
                action="{{ route('set-ticap-name') }}"
                method="post">
                @csrf
                @error('ticap')
                    <span>{{ $message }}</span>
                @enderror
                <div class="m-auto">
                    <div class="text-center">
                        <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Set TICaP Name</label>
                    </div>
                    <input type="text" name="ticap" class="rounded w-full text-black dark:text-gray-900">
                </div>
                <div class="text-center">
                    <button type="submit" class="md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">Set</button>
                </div>
            </form>
        </div>
        </div>
    
</section>
</html>
</x-app-layout>