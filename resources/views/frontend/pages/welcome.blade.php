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

        </div>
    </div>
@endsection
