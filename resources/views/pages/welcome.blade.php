<x-layouts.app>
    @push('plugin-scripts')
        @vite(['resources/js/home.js', 'resources/js/slider.js', 'resources/js/gsap.js'])
    @endpush

    <div class="max-lg:hidden">
        <div class="-mt-72" id="smooth-wrapper">
            <div class="relative" id="smooth-content">
                <img class="h-auto w-full" id="mainbackground" src="{{ asset('img/main-bg-3.png') }}" alt="mainbackground">
                {{-- <img src="{{ asset('img/cave1-1-01-sm.png') }}" alt="" class="absolute inset-0 w-full h-full object-cover"> --}}
                {{-- Cloud images --}}
                <div class="absolute right-[16%] top-[14%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="right" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 290px; height: auto;">
                    </div>
                </div>
                <div class="absolute right-[15%] top-[19%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="right" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 100px; height: auto;">
                    </div>
                </div>
                <div class="absolute left-[20%] top-[30%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="right" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 300px; height: auto;">
                    </div>
                </div>
                <div class="absolute left-[60%] top-[66%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="left" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 150px; height: auto;">
                    </div>
                </div>
                <div class="absolute left-[10%] top-[70.8%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="left" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 240px; height: auto;">
                    </div>
                </div>
                <div class="absolute left-[10%] top-[76%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="left" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 90px; height: auto;">
                    </div>
                </div>
                <div class="absolute right-[28%] top-[84%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="right" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 360px; height: auto;">
                    </div>
                </div>
                <div class="absolute right-[20%] top-[88%] w-[10vw]">
                    <div class="relative h-full w-full">
                        <img class="cloud absolute h-auto w-auto" data-direction="right" data-speed="1"
                            src="{{ asset('img/cloud.png') }}" alt="" style="width: 100px; height: auto;">
                    </div>
                </div>
                {{-- End of Cloud images --}}
                {{-- Text Image --}}
                <a class="absolute right-[32%] top-[26%]" href="{{ route('tictacstation') }}">
                    <img class="text-image w-[20vw]" src="{{ asset('img/text/tictacstation.png') }}"
                        alt="tictacstation" title="tictacstation">
                    <p class="text-pretty text-center text-white">
                        {!! __('home.tictacstation') !!}
                    </p>
                </a>
                {{-- <a class="absolute left-[13%] top-[45%]" href="{{ route('tictactivity.index') }}"> --}}
                <a class="absolute left-[13%] top-[45%]" href="#">
                    <img class="text-image w-[20vw]" src="{{ asset('img/text/tictactivity.png') }}" alt="TicTacTivity"
                        title="TicTacTivity">
                    <p class="text-center text-white">
                        {!! __('home.tictactivity') !!}
                    </p>
                </a>
                <a class="absolute right-[10%] top-[59%]" href="{{ route('tictalks.index') }}">
                    <img class="text-image w-[20vw]" src="{{ asset('img/text/tictactalks.png') }}" alt="TicTacTalks"
                        title="TicTacTalks">
                    <p class="text-center text-white">
                        {!! __('home.tictalks') !!}
                    </p>
                </a>

                @guest
                    <div class="absolute left-[33%] top-[82%] cursor-pointer"
                        @click="()=>{
                    openAuth = !openAuth;
                    openMobileNav = false;
                }">
                    @endguest
                    @auth('web')
                        <a class="absolute left-[33%] top-[82%]" href="{{ route('gameon') }}">
                        @endauth

                        <img class="text-image w-[15vw]" src="{{ asset('img/text/gameon.png') }}" alt="gameon"
                            title="gameon">
                        <p class="text-center text-white">
                            {!! __('home.gameon') !!}
                        </p>
                        @auth('web')
                        </a>
                    @endauth
                    @guest
                    </div>
                @endguest
                {{-- character images --}}
                <div class="absolute right-[26.5%] top-[17.7%]">
                    <img class="text-image w-[13vw]" src="{{ asset('img/char/original.gif') }}" alt="original"
                        title="original">
                </div>
                {{-- bush --}}
                <div class="absolute right-[29.6%] top-[18.7%]">
                    <img class="w-[17.1vw]" src="{{ asset('img/bush-2.png') }}" alt="bush" title="bush">
                </div>
                <div class="absolute right-[33%] top-[36%]">
                    <img class="text-image w-[13vw]" src="{{ asset('img/char/cow.gif') }}" alt="TicTacTivity"
                        title="TicTacTivity">
                </div>
                <div class="absolute left-[11%] top-[58%]">
                    <img class="text-image w-[12vw]" src="{{ asset('img/char/seaweed.gif') }}" alt="gameon"
                        title="gameon">
                </div>
                <div class="absolute right-[20%] top-[50%]">
                    <img class="text-image w-[12vw]" src="{{ asset('img/char/mix.gif') }}" alt="TicTacTalks"
                        title="TicTacTalks">
                </div>
                <div class="absolute left-[44%] top-[79%]">
                    <img class="text-image w-[15vw]" src="{{ asset('img/char/spicy.gif') }}" alt="TicTacTalks"
                        title="TicTacTalks">
                </div>
                <div class="absolute right-[13%] top-[71%]">
                    <img class="text-image w-[12vw]" src="{{ asset('img/char/noodle.gif') }}" alt="TicTacTalks"
                        title="TicTacTalks">
                </div>
            </div>
        </div>

        <div class="fixed right-[4%] top-[20%] w-[7vw]">
            <div class="cloud relative w-full" data-direction="left" data-speed="1">
                <img class="z-0 h-auto w-auto" src="{{ asset('img/air_baloon_2.png') }}" alt=""
                    style="width: 310px; height: auto;">

                <div class="clamp-[gap,2,5] absolute left-[32%] top-1/2 my-2 flex flex-col justify-center">

                    @php
                        $socials = [
                            [
                                'name' => 'whatsaap',
                                'image' => asset('img/social-icons/wa.svg'),
                                'link' => db_config('social.whatsapp'),
                            ],
                            [
                                'name' => 'facebook',
                                'image' => asset('img/social-icons/fb.svg'),
                                'link' => db_config('social.facebook'),
                            ],
                            [
                                'name' => 'tiktok',
                                'image' => asset('img/social-icons/tiktok.svg'),
                                'link' => db_config('social.tiktok'),
                            ],
                            [
                                'name' => 'instagram',
                                'image' => asset('img/social-icons/ig.svg'),
                                'link' => db_config('social.instagram'),
                            ],
                            [
                                'name' => 'youtube',
                                'image' => asset('img/social-icons/yt.svg'),
                                'link' => db_config('social.youtube'),
                            ],
                        ];

                        $socials = array_filter($socials, fn($s) => !empty($s['link']));
                    @endphp

                    @foreach ($socials as $social)
                        <a href="{{ $social['link'] }}" target="_blank">
                            <img class="size-[1.5vw]" src="{{ $social['image'] }}" alt="{{ $social['name'] }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>


    @if (db_config('pop-up.enable', false))
        <x-pop-up />
    @endif


    <x-home.slider.main />

</x-layouts.app>
