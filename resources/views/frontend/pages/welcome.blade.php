@extends('frontend.layouts.app')

@section('title', 'Welcome')

@push('plugin-scripts')

    @vite(['resources/js/gsap.js'])

@endpush

@section('content')
    {{-- ...existing code or welcome page content... --}}

    <div id="smooth-wrapper">
        <div class="relative pt-28" id="smooth-content">
            <img src="{{ asset('img/grafich bg--sm.png') }}" alt="" id="mainbackground" class="w-full h-auto">
            <img src="{{ asset('img/cave1-1-01-sm.png') }}" alt="" class="absolute inset-0 w-full h-full object-cover">

            {{-- Cloud images --}}

            <div class="top-[4%] right-[16%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="right" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 290px; height: auto;">
                </div>
            </div>

            <div class="top-[9%] right-[15%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="right" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 100px; height: auto;">
                </div>
            </div>

            <div class="top-[30%] left-[20%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="right" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 300px; height: auto;">
                </div>
            </div>

            <div class="top-[66%] left-[60%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="left" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 150px; height: auto;">
                </div>
            </div>

            <div class="top-[70.8%] left-[10%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="left" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 240px; height: auto;">
                </div>
            </div>

            <div class="top-[76%] left-[10%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="left" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 90px; height: auto;">
                </div>
            </div>

            <div class="top-[84%] right-[28%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="right" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 360px; height: auto;">
                </div>
            </div>

            <div class="top-[88%] right-[20%] absolute w-[200px] h-[200px]">
                <div class="relative w-full h-full">
                    <img data-direction="right" data-speed="1" src="{{ asset('img/cloud.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 100px; height: auto;">
                </div>
            </div>

            {{-- End of Cloud images --}}


            {{-- Text Image --}}
            <a href="#" class="top-[26.7%] right-[32%] absolute">
                <img src="{{ asset('img/text/Website TicTac-04.png') }}" alt="Crunch Selection" title="Crunch Selection" class="w-[355px] text-image">
            </a>

            <a href="#" class="top-[49.5%] left-[13%] absolute">
                <img src="{{ asset('img/text/Website TicTac-05.png') }}" alt="TicTacvity" title="TicTacvity" class="w-[355px] text-image">
            </a>

            <a href="#" class="top-[62.1%] right-[10%] absolute">
                <img src="{{ asset('img/text/Website TicTac-06.png') }}" alt="TicTacvity" title="TicTacvity" class="w-[355px] text-image">
            </a>

            <a href="#" class="top-[83.6%] left-[33.8%] absolute">
                <img src="{{ asset('img/text/Website TicTac-07.png') }}" alt="TicTacvity" title="TicTacvity" class="w-[355px] text-image">
            </a>

        </div>
    </div>

    <div class="top-[20%] right-[4%] fixed w-[180px]">
        <div class="relative w-full">
            <img data-direction="left" data-speed="1" src="{{ asset('img/air_baloon.png') }}" alt="" class="absolute w-auto h-auto cloud" style="width: 290px; height: auto;">
        </div>
    </div>
@endsection
