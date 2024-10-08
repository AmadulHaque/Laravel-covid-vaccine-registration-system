<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Welcome our COVID reg.' }} </title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="">
     
        <section class="py-[64px] relative overflow-hidden flex items-center justify-center" >
            <div class="absolute inset-0">
                <img src="https://themes.coderthemes.com/aeropage/assets/bg-1-BVx-W3eB.png" class="dark:hidden h-full w-full">
                <img src="https://themes.coderthemes.com/aeropage/assets/bg-2-dark-DrwqoD0p.jpg" class="hidden dark:block h-full w-full">
            </div>

            <div class="container">
                <div class="relative">  
                    <nav class="bg-white border-gray-200 dark:bg-gray-900">
                        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
                            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">COVID</span>
                            </a>
                            <form class="w-[350px]" action="{{ route('vaccine.status') }}" method="GET">
                                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="number" name="nid" value="{{ request('nid') ?? '' }}" id="search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search National ID (NID)" required />
                                    <button type="submit" class="text-white absolute end-0 bottom-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                            </form>
                            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                                    <li>
                                        <a href="{{route('vaccine.register')}}" class="block py-2 px-3 md:p-0 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500" aria-current="page">Registration </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="bg-white border-gray-200 dark:bg-gray-900 mt-5 pt-5">
                        @yield('content')
                    </div>
                </div>
            </div>


        </section>
    </body>
</html>
