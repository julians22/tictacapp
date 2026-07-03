<!DOCTYPE html>
<html lang="{{ html_lang() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $alternateLangs = get_alternate_lang_properties();
    @endphp

    @if (count($alternateLangs) > 0)
        @foreach ($alternateLangs as $item)
            <link rel="alternate" hreflang="{{ $item['code'] }}" href="{{ $item['href'] }}"/>
        @endforeach
    @endif

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @metadata

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <!-- Add your CSS links here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- plugin scripts --}}
    @stack('plugin-scripts')

    {{-- add custom css --}}
    @stack('custom-css')
    @livewireStyles

    @if (app()->environment('production'))
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-06NNYPZ0KQ"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-06NNYPZ0KQ');
        </script>
    @endif

</head>

<body x-data="{ openAuth: false, openPopUp: true, openMobileNav: false }" @class([
    'bg-linear-0 from-tictac-primary-blue to-tictac-primary-blue-light relative min-h-screen via-50% flex-1 flex flex-col',
])>
    <header class="z-10 relative mt-8 max-lg:mb-8 container">
        <div
            class="relative flex justify-between lg:justify-end-safe items-center content-center text-white clamp-[gap,2,4]">
            <div class="lg:hidden">
                <div class="top-0 left-0 z-50 relative flex justify-between w-full transition-all duration-300"
                    @click="openMobileNav = !openMobileNav">
                    <x-lucide-menu class="size-8" />
                </div>

                <x-mobile-nav />
            </div>

            <div class="flex justify-between items-center content-center clamp-[gap,2,4]">
                <x-locale-toggler />

                <div class="inline-block bg-white w-0.5 h-full min-h-[1em]"></div>

                @guest
                    <x-modal model="openAuth">
                        <x-slot:trigger>
                            <div class="flex items-center gap-2 cursor-pointer">
                                <x-lucide-lock class="size-8" />
                                <span class="font-winky-sans">Login</span>
                            </div>
                        </x-slot:trigger>

                        <div class="mx-auto w-max">
                            <livewire:auth-modal />
                        </div>
                    </x-modal>
                @endguest

                @auth('web')
                    <div class="flex items-center gap-2">
                        <span class="font-winky-sans text-white">Logged in as {{ explode(' ', auth('web')->user()->name)[0] }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="font-winky-sans text-tictac-secondary-yellow hover:text-tictac-primary-blue cursor-pointer"
                                type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

        </div>

        <x-nav />
    </header>

    <main class="inline-flex flex-col flex-1 w-full max-w-dvw font-sans" id="main-content">
        {{ $slot }}
    </main>

    <footer class="px-4">
        <div class="my-8">
            <p class="text-white text-center clamp-[text,sm,lg]">
                Designed by Designcub3. 2025. Copyright to Tic Tac Dua Kelinci.
            </p>
            <div class="text-center text-xs mt-2 text-white">
                <a href="{{ route('terms') }}" 
                    class="cursor-pointer underline"
                >
                    {{ __('auth.Terms_Conditions') }}
                </a> 
                |
                <a href="{{ route('privacy') }}" 
                    class="cursor-pointer underline"
                >
                    {{ __('auth.privacy_policy') }}
                </a>
            </div>
        </div>
    </footer>

    @stack('custom-scripts')

    @livewireScripts
</body>

</html>
