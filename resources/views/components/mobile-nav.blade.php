<!-- Menu Mobile -->
<nav class="lg:hidden" x-cloak>
    <div class="md:hidden top-0 left-0 z-40 fixed flex flex-col justify-center items-center bg-linear-to-b from-tictac-secondary-blue to-tictac-primary-blue w-full min-h-screen text-white"
        x-show="openMobileNav" x-transition:enter="transform transition duration-500 ease-in-out"
        x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition duration-500 ease-in-out"
        x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-full opacity-0">
        <ul
            class="flex flex-col flex-wrap justify-between items-center gap-4 p-4 font-sans font-bold text-xl text-center">
            {{-- menulist --}}
            {{-- Crunch Selection, TicTactivity, Logo Image, TicTalks, Game On! --}}
            <li data-before-content="TicTacapp">
                <a class="flex items-center text-white" href="{{ route('home') }}">
                    <img class="w-60 h-auto" src="{{ asset('img/logo.png') }}" alt="Logo" />
                </a>
            </li>

            <li data-before-content="TicTacStation" @class([
                'nav--item-outline' => request()->routeIs('tictacstation'),
            ])>
                <a class="text-white" href="{{ route('tictacstation') }}">TicTacStation</a>
            </li>

            <li data-before-content="TicTactivity" @class([
                'nav--item-outline' => request()->routeIs('tictactivity.*'),
            ])>
                {{-- <a class="text-white" href="{{ route('tictactivity.index') }}">TicTactivity</a> --}}
                <a class="text-gray-500 cursor-not-allowed" href="#">TicTactivity</a>
            </li>


            <li data-before-content="TicTalks" @class([
                'nav--item-outline' => request()->routeIs('tictalks.*'),
            ])>
                <a class="text-white" href="{{ route('tictalks.index') }}">TicTalks</a>
                {{-- <a class="text-gray-500 cursor-not-allowed" href="#">TicTalks</a> --}}
            </li>

            <li data-before-content="Game On!" @class([
                'nav--item-outline' => request()->routeIs('gameon'),
            ])>
                @auth('web')
                    <a class="text-white" href="{{ route('gameon') }}">Game On!</a>
                @endauth

                @guest
                    <p class="text-white cursor-pointer"
                        @click="()=>{
                        openAuth = !openAuth;
                        openMobileNav = false;
                    }">
                        Game On!</p>
                @endguest
            </li>
        </ul>
    </div>
</nav>
