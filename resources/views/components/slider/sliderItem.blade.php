@props(['item', 'routeName' => null])
<style>
    #activitySlider .swiper-wrapper {
        align-items: stretch;
    }

    #activitySlider .swiper-slide {
        height: auto;
        display: flex;
    }
</style>
<div class="flex mb-10 h-auto swiper-slide"
    @if (isset($item->key) || isset($item->id)) wire:key="{{ isset($item->key) ? $item->key : $item->id }}" @endif>
    <div class="relative flex flex-col bg-tictac-primary-blue slider-outer-shadow mb-10 p-2 rounded-4xl w-full h-full">
        <div class="flex flex-col bg-white slider-inner-shadow rounded-3xl h-full overflow-clip">
            <div class="aspect-6/4 overflow-hidden">
                <img
                    class="w-full h-full object-cover"
                    src="{{ $item->getFirstMediaUrl('thumbnail', 'webp_small') ? $item->getFirstMediaUrl('thumbnail', 'webp_small') : 'https://placehold.co/600x400' }}"
                    alt="{{ $item->title ?? '' }}">
            </div>

            <div class="flex flex-col flex-1 gap-4 px-4 pt-6 pb-10 text-center">
                <p class="font-bold text-orange-500 text-sm underline tracking-widest">
                    {{ $item->category->name ?? '' }}
                </p>

                <h3 class="font-sans font-bold text-tictac-primary-blue text-lg md:text-2xl">
                    {{ $item->title ?? '' }}
                </h3>

                <p class="text-base">
                    {{ Str::limit($item->description ? $item->description : '', 150, '...') }}
                </p>
            </div>
        </div>

        <a class="block -bottom-4 left-1/2 absolute bg-tictac-primary-blue slider-outer-shadow p-2 rounded-full overflow-clip font-winky-sans font-semibold text-center -translate-x-1/2"
            {{-- href="{{ $link }}" --}} href="{{ $routeName ? route($routeName . '.show', $item->slug) : '#' }}">
            <span class="block relative bg-tictac-secondary-yellow slider-inner-shadow py-2 rounded-full overflow-clip">
                <span class="block px-3 py-1 size-full text-tictac-primary-blue text-base">@lang('global.read_more')</span>
            </span>
        </a>
    </div>
</div>
