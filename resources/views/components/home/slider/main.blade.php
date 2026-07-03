<div class="relative lg:hidden">

    <div class="z-0 size-full">
        <img class="cloud-slider absolute left-[15%] top-0 h-[15%]" data-direction="right" data-speed="1"
            src="{{ asset('img/cloud.png') }}" alt="" />
        <img class="cloud-slider absolute right-[5%] top-1/4 h-[10%]" data-direction="left" data-speed="1"
            src="{{ asset('img/cloud.png') }}" alt="" />

    </div>

    <!-- Slider main container -->
    <div class="swiper px-8! flex! min-h-[50dvh] items-center justify-center max-lg:hidden" id="home-mobile-slider">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @php
                $items = [
                    [
                        'islandImage' => asset('img/mobile/tictacstation.png'),
                        'textImage' => asset('img/text/tictacstation.png'),
                        'text' => 'Click here to read more about our product varieties >',
                        'classModifier' => '',
                        'link' => route('tictacstation'),
                    ],
                    [
                        'islandImage' => asset('img/mobile/tictactivity.png'),
                        'textImage' => asset('img/text/tictactivity.png'),
                        'text' => 'Click here to read more about our recent campaign >',
                        'classModifier' => '-ml-32 scale-125 mt-8',
                        'link' => route('tictactivity.index'),
                    ],
                    [
                        'islandImage' => asset('img/mobile/tictactalks.png'),
                        'textImage' => asset('img/text/tictactalks.png'),
                        'text' => 'Click here to read more about our intriguing articles >',
                        'classModifier' => '',
                        'link' => route('tictalks.index'),
                    ],
                    [
                        'islandImage' => asset('img/mobile/gameon.png'),
                        'textImage' => asset('img/text/gameon.png'),
                        'text' => 'Click here to play some exciting games >',
                        'classModifier' => '-ml-32 -mb-8 scale-110',
                        'link' => route('gameon'),
                    ],
                ];
            @endphp

            @foreach ($items as $item)
                <x-home.slider.slide-item class="{{ $item['classModifier'] }}" :item="$item" />
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <div class="my-2 flex flex-wrap justify-center gap-8 pt-8">
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
                <img class="size-8" src="{{ $social['image'] }}" alt="">
            </a>
        @endforeach
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let homeSlider;
            let homeCloud;
            let isMobile = false;
            const maxWidth = "64rem";

            const initSlider = () => {
                homeSlider = new window.Swiper("#home-mobile-slider", {

                    slidesPerView: 1,
                    parallax: true,
                    // slidesPerView: "auto",
                    spaceBetween: 200,
                });

                const clouds = document.querySelectorAll(".cloud-slider");

                clouds.forEach((cloudImg, index) => {
                    const wrapper = cloudImg.parentElement;

                    // Get data attributes from the cloud image
                    const direction = cloudImg.getAttribute("data-direction") || "left";

                    homeCloud = window.gsap.to(cloudImg, {
                        x: Math.random() * (direction === "left" ? -70 : 70),
                        duration: 4 + Math.random() * 2,
                        ease: "sine.inOut",
                        yoyo: true,
                        repeat: -1,
                        delay: 1 + Math.random(),
                    });
                });

            };

            if (window.matchMedia(`screen and (max-width: ${maxWidth})`).matches) {
                isMobile = true;
                initSlider();
            }

            const homeSliderResizeHandler = () => {
                if (window.matchMedia(`screen and (max-width: ${maxWidth})`).matches) {
                    if (!isMobile) {
                        isMobile = true;
                        initSlider();
                    }
                } else {
                    if (isMobile) {
                        if (homeSlider) {}

                        if (homeCloud) {
                            homeSlider.kill();
                            homeSlider = null;
                        }
                        isMobile = false;
                    }
                }
            };

            window.addEventListener("resize", homeSliderResizeHandler);
        });
    </script>
@endpush
