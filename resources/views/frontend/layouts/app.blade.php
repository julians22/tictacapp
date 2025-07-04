<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Tictacapp') }}</title>

    {{-- add font css from local assets --}}
    <link rel="stylesheet" href="{{ asset('fonts/font.css') }}">

    <!-- Add your CSS links here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- plugin scripts --}}
    @stack('plugin-scripts')

    {{-- add custom css --}}
    @stack('custom-css')

</head>
<body class="relative min-h-screen">
    <div class="z-0 absolute inset-0 bg-blue-400 from-fuchsia-200 to-blue-400"></div>

    <header class="z-10 relative">

        <nav
            class="mx-auto text-white container">
            <ul class="flex justify-between items-center p-4 *:font-coopbl font-semibold text-xl *:text-center">

                {{-- menulist --}}
                {{-- Crunch Selection, TicTacvity, Logo Image, TicTalks, Game On! --}}
                <li>
                    <a href="{{ url('/') }}" class="text-white hover:text-gray-300">Crunch <br> Selection</a>
                </li>
                <li>
                    <a href="{{ url('/tictacvity') }}" class="text-white hover:text-gray-300">TicTacvity</a>
                </li>
                <li>
                    <a href="{{ url('/') }}" class="flex items-center text-white hover:text-gray-300">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-[240px] h-auto" />
                    </a>
                </li>
                <li>
                    <a href="{{ url('/tictalks') }}" class="text-white hover:text-gray-300">TicTalks</a>
                </li>
                <li>
                    <a href="{{ url('/gameon') }}" class="text-white hover:text-gray-300">Game On!</a>
                </li>


            </ul>

        </nav>

    </header>
    <main class="z-10 relative" id="main-content">
        {{-- Main content will be injected here --}}
        {{-- This is where the content of each page will be displayed --}}
        @yield('content')
    </main>
    <footer>
        <!-- Optional: Add footer here -->
    </footer>

</body>
</html>
