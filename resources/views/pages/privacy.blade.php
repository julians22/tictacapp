<x-layouts.tictack class="before:bg-[url('../assets/bg/detail-bg-island.png')]">
    <div class="flex flex-col items-center justify-center px-4 py-12 gap-8">
        <div class="relative bg-card-blue slider-outer-shadow rounded-4xl w-full max-w-4xl clamp-[p,2,3]">
            <div class="relative bg-white slider-inner-shadow rounded-3xl clamp-[p,4,8] text-tictac-primary-blue flex flex-col gap-4">
                <h1 class="font-bold text-2xl text-center">
                    {{ __('privacy.title') }}
                </h1>
                <p>
                    {!! __('privacy.intro', [
                        'site' => '<a href="https://tictacland.com" target="_blank"><b>tictacland.com</b></a>'
                    ]) !!}
                </p>
                <div>
                    <h2 class="font-bold">{{ __('privacy.collect_title') }}</h2>
                    <p>{{ __('privacy.collect_desc') }}</p>
                    <ul class="list-disc ml-5">
                        <li>{{ __('privacy.collect_1') }}</li>
                        <li>{{ __('privacy.collect_2') }}</li>
                    </ul>
                </div>
                <div>
                    <h2 class="font-bold">{{ __('privacy.usage_title') }}</h2>
                    <p>{{ __('privacy.usage_desc') }}</p>
                    <ul class="list-disc ml-5">
                        <li>{{ __('privacy.usage_1') }}</li>
                        <li>{{ __('privacy.usage_2') }}</li>
                        <li>{{ __('privacy.usage_3') }}</li>
                    </ul>
                </div>
                <div>
                    <h2 class="font-bold">{{ __('privacy.thirdparty_title') }}</h2>
                    <p>
                        {!! __('privacy.thirdparty_desc', [
                            'google' => '<a href="https://policies.google.com/privacy" target="_blank"><b>Google Privacy & Terms</b></a>'
                        ]) !!}
                    </p>
                </div>
                <div>
                    <h2 class="font-bold">{{ __('privacy.nologin_title') }}</h2>
                    <p>
                        {!! __('privacy.nologin_desc', [
                            'site' => '<a href="https://tictacland.com" target="_blank"><b>tictacland.com</b></a>'
                        ]) !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="{{ route('home') }}"
                class="relative bg-card-blue slider-outer-shadow rounded-full cursor-pointer">
                <span class="block relative bg-tictac-secondary-yellow slider-inner-shadow rounded-full">
                    <span class="block px-6 py-2 font-winky-sans font-bold text-tictac-primary-blue text-center">
                        {{ __('global.back_to_home') }}
                    </span>
                </span>
            </a>
        </div>
    </div>
</x-layouts.tictack>