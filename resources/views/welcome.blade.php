<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
<style>
    /* Basic styles for HTML elements */
    ::after, ::before {
        box-sizing: border-box;
        border-width: 0;
        border-style: solid;
        border-color: #e5e7eb;
    }

    html {
        line-height: 1.5;
        font-family: Figtree, sans-serif;
    }

    body {
        margin: 0;
    }

    h1 {
        font-size: 40px;
        color: #ef4444;
        font-weight: 700;
        background-color: rgba(255, 255, 255, 0.8);
    }

    /* Additional styles for specific classes */
    .relative {
        position: relative;
    }

    .flex {
        display: flex;
    }

    .inline-flex {
        display: inline-flex;
    }

    .grid {
        display: grid;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .font-semibold {
        font-weight: 600;
    }

    .bg-gray-100 {
        background-color: rgba(243, 244, 246, 1);
    }

    .bg-white {
        background-color: #ffffff;
    }

    .dark\:bg-gray-900 {
        background-color: rgb(17 24 39);
    }

    .dark\:bg-dots-lighter {
        background-image: url("/image/bgimage.jpeg");
    }

    .text-gray-600 {
        color: rgb(245, 245, 245);
    }

    .text-gray-900 {
        color: rgba(17, 24, 39, 1);
    }

    .p-6 {
        padding: 1.5rem;
    }
</style>
    </head>
    <body class="antialiased" >
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('admin/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

           
                <!-- Content goes here -->
            </div>
            
            <div style="background-image: url('/image/banner.jpg'); background-repeat: no-repeat; background-position: center; height: 100vh;">
                <h1 style="font-size: 40px; color: #ef4444; font-weight: 700; background-color: rgba(255, 255, 255, 0.8); text-align:center;padding-top: 20vh" >
                    
                </h1>
            </div>
        

    </body>
</html>
